<?php

namespace App\Controller\Front;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\CategorieRepository;
use App\Repository\MarqueRepository;
use App\Repository\ProduitRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front', name: 'front_')]
class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'produit_index', methods: ['GET'])]
    public function index(Request $request,PaginatorInterface $paginator,ProduitRepository $produitRepository,CategorieRepository $categorieRepository,MarqueRepository $marqueRepository): Response
    {
        $produits=$produitRepository->findAll();
        $produitsFeatured=$produitRepository->findBy(array('featured' => true));
        $marques=$marqueRepository->findAll();
        $categories=$categorieRepository->findAll();

        $pagination = $paginator->paginate(
            $produits, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );

        return $this->render('front/produit/index.html.twig', [
            'produits' => $pagination,
            'categories' => $categories,
            'marques' => $marques,
            'produitsFeatured' => $produitsFeatured,
        ]);
    }

    #[Route('/produit/{id}', name: 'produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('front/produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }
}
