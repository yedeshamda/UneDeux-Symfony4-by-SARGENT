<?php

namespace App\Controller\Front;

use App\Entity\Notification;
use App\Entity\User;
use App\Form\UserInscriptionType;
use App\Form\UserUpdatePasswordType;
use App\Form\UserUpdateType;
use App\Repository\CategorieRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/{_locale<en|fr>}', name: 'front_')]
class UserController extends AbstractController
{
    private $passwordHasher;
    private EntityManagerInterface $entityManager;

    public function __construct(UserPasswordHasherInterface $passwordHasher,EntityManagerInterface $entityManager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }


    #[Route('/user/new', name: 'user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository,CategorieRepository $categorieRepository): Response
    {
        $user = new User();
        $categories = $categorieRepository->findAll();
        $form = $this->createForm(UserInscriptionType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user->setRoles(["ROLE_USER"]);

            $user->setPassword($this->passwordHasher->hashPassword(
                $user, $form->get('password')->getData()));

            $users=$userRepository->getallusersAdmin();
            foreach($users as $element) {
                $notification = new Notification();
                $notification->setMessage("Une DEUX viens de recevoir une nouvelle inscription");
                $notification->setUser($element);
                $this->entityManager->persist($notification);

            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('front_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/user/new.html.twig', [
            'categories' => $categories,
            'user' => $user,
            'form' => $form,
        ]);
    }


    #[Route('/userProfile/{id}', name: 'user_profile', methods: ['GET'])]
    public function showProfile(User $user, UserRepository $userRepository, int $id, CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();
        $user = $userRepository->find($id);
        if ($this->getUser() != $user) {
            return $this->redirectToRoute('home');
        }

        return $this->render('front/user/show_profile.html.twig', [
            'categories' => $categories,
            'user' => $user,
        ]);
    }


    #[Route('/user/{id}/editPassword', name: 'user_edit_password', methods: ['GET', 'POST'])]
    public function editPassword(Request $request, User $user, CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();
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

                return $this->redirectToRoute('front_home');
            }else
             {
                $this->addFlash('error','Ancien mot de passe non valide');
             }
        }

        return $this->renderForm('front/user/editPassword.html.twig', [
            'categories' => $categories,
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/user/{id}/edit', name: 'user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();
        $form = $this->createForm(UserUpdateType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('front_home');
        }

        return $this->renderForm('front/user/edit.html.twig', [
            'categories' => $categories,
            'user' => $user,
            'form' => $form,
        ]);
    }

}
