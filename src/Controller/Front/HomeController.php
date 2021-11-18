<?php

namespace App\Controller\Front;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategorieRepository;
use App\Repository\MarqueRepository;
use App\Repository\ProduitRepository;

#[Route('/{_locale<en|fr>}', name: 'front_')]
class HomeController extends AbstractController
{
    #[Route('/home', name: 'home', methods: ['GET'])]
    public function index(PaginatorInterface $paginator,Request $request,ProduitRepository $produitRepository,CategorieRepository $categorieRepository,MarqueRepository $marqueRepository): Response
    {
        $produits=$produitRepository->findAll();
        $marques=$marqueRepository->findAll();
        $categories=$categorieRepository->findAll();

        $pagination = $paginator->paginate(
            $categories, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );

        return $this->render('front/home/index.html.twig', [
            'produits' => $produits,
            'categories' => $pagination,
            'marques' => $marques,
        ]);
    }

    #[Route('/qui_somme_nous', name: 'qui_somme_nous', methods: ['GET'])]
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
}
