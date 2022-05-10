<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserUpdatePasswordType;
use App\Form\UserUpdateType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin', name: 'admin_')]
class UserController extends AbstractController
{
    private $passwordHasher;
    private EntityManagerInterface $entityManager;

    public function __construct(UserPasswordHasherInterface $passwordHasher,EntityManagerInterface $entityManager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }

    #[Route('/user', name: 'user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/user/new', name: 'user_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user->setRoles(["ROLE_ADMIN"]);

            $user->setPassword($this->passwordHasher->hashPassword(
                $user, $form->get('password')->getData()));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/user/{id}', name: 'user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/userProfile/{id}', name: 'user_profile', methods: ['GET'])]
    public function showProfile(User $user, UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->find($id);
        if ($this->getUser() != $user) {
            return $this->redirectToRoute('home');
        }

        return $this->render('admin/user/show_profile.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/user/{id}/edit', name: 'user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserUpdateType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->renderForm('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/user/{id}/editPassword', name: 'user_edit_password', methods: ['GET', 'POST'])]
    public function editPassword(Request $request, User $user, ParametreRepository $parametreRepository): Response
    {
        $form = $this->createForm(UserUpdatePasswordType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $oldpass=$form->get('oldPassword')->getData();
            $new=$form->get('password')->getData();
             if ($this->passwordHasher->isPasswordValid($user,$oldpass)) {
                $user->setPassword($this->passwordHasher->hashPassword(
                    $user, $new));
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return $this->redirectToRoute('admin_user_index');
            }else
             {
                $this->addFlash('error','Ancien mot de passe non valide');
             }
        }

        return $this->renderForm('admin/user/editPassword.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/user/{id}', name: 'user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/user/{id}/bloquer', name: 'user_bloquer', methods: ['GET'])]
    public function bloquer(Request $request, User $user): Response
    {
        if ($user->getEtat() == 1 ){
            $user->setEtat(0);
        }elseif($user->getEtat() == 0) {
            $user->setEtat(1);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
