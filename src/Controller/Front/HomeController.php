<?php

namespace App\Controller\Front;

use App\Entity\Contact;
use App\Entity\Notification;
use App\Entity\User;
use App\Form\ContactType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategorieRepository;
use App\Repository\MarqueRepository;
use App\Repository\ProduitRepository;

#[Route('/', name: 'front_')]
class HomeController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/{_locale<en|fr>}', name: 'home', methods: ['GET'],defaults: ['_locale'=>'fr'])]
    public function index(PaginatorInterface $paginator,Request $request,ProduitRepository $produitRepository,CategorieRepository $categorieRepository,MarqueRepository $marqueRepository): Response
    {
        $produits=$produitRepository->findAll();
        $marques=$marqueRepository->findAll();
        $categories=$categorieRepository->findAll();

        return $this->render('front/home/index.html.twig', [
            'produits' => $produits,
            'categories' => $categories,
            'marques' => $marques,
        ]);
    }

    #[Route('/{_locale<en|fr>}/qui_somme_nous', name: 'qui_somme_nous', methods: ['GET'])]
    public function quiSommeNous(ProduitRepository $produitRepository,CategorieRepository $categorieRepository,MarqueRepository $marqueRepository): Response
    {
        $produits=$produitRepository->findAll();
        $marques=$marqueRepository->findAll();
        $categories=$categorieRepository->findAll();


        return $this->render('front/home/qui_somme_nous.html.twig', [
            'produits' => $produits,
            'categories' => $categories,
            'marques' => $marques,
        ]);
    }


    #[Route('/{_locale<en|fr>}/contact', name: 'contact')]
    public function contact(Request $request,CategorieRepository $categorieRepository, UserRepository $userRepository): Response
    {
        $categories=$categorieRepository->findAll();

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();

            $users=$userRepository->getallusersAdmin();
            foreach($users as $element) {
                $notification = new Notification();
                $notification->setMessage("Une DEUX viens de recevoir un message");
                $notification->setUser($element);
                $this->entityManager->persist($notification);

            }

            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('front_home', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('front/home/contact.html.twig', [
            'categories' => $categories,
            'contact' => $contact,
            'form' => $form,
        ]);
    }
}
