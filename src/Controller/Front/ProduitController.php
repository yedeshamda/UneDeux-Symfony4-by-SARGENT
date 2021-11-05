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
    #[Route('/produit', name: 'produit_index', methods: ['GET','POST'])]
    public function index(Request $request, PaginatorInterface $paginator, ProduitRepository $produitRepository, CategorieRepository $categorieRepository, MarqueRepository $marqueRepository): Response
    {
        $produitsFeatured = $produitRepository->findBy(array('featured' => true));
        $marques = $marqueRepository->findAll();
        $categories = $categorieRepository->findAll();
        $produits = $produitRepository->findAll();

        if($request->isMethod('POST'))
        {
            $reqCategories = $request->request->get('categ');
            $reqMarques = $request->request->get('marq');
            if (empty($reqCategories) && empty($reqMarques)) {
                $produits = $produitRepository->findAll();

            } else {

                $produits = $produitRepository->searchByFilter($reqCategories, $reqMarques);

            }
        }

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

    #[Route('/produit/show/{id}', name: 'produit_show', methods: ['GET'])]
    public function show(Request $request, int $id, ProduitRepository $produitRepository, CategorieRepository $categorieRepository, MarqueRepository $marqueRepository): Response
    {
        $marques = $marqueRepository->findAll();
        $categories = $categorieRepository->findAll();
        $produitsFeatured = $produitRepository->findBy(array('featured' => true));
        $produit = $produitRepository->find($id);
        $produits = $produitRepository->findBy(
            ['nom' => ['Produit1', 'Produit2', 'Produit3', 'Produit4']],
        );

        return $this->render('front/produit/show.html.twig', [
            'categories' => $categories,
            'marques' => $marques,
            'produit' => $produit,
            'produits' => $produits,
            'produitsFeatured' => $produitsFeatured,
        ]);
    }

    #[Route('/produit/search', name: 'produit_search', methods: ['POST'])]
    public function searchAction(Request $request, ProduitRepository $produitRepository, CategorieRepository $categorieRepository, MarqueRepository $marqueRepository)
    {
        $produitsFeatured = $produitRepository->findBy(array('featured' => true));
        $marques = $marqueRepository->findAll();
        $categories = $categorieRepository->findAll();

        $data = $request->request->get('search-name');
        $res = $produitRepository->search($data);
        return $this->render('front/produit/search.html.twig', array(
                'res' => $res,
                'categories' => $categories,
                'marques' => $marques,
                'produitsFeatured' => $produitsFeatured,)
        );
    }

    #[Route('/produit/search2', name: 'produit_search2', methods: ['POST'])]
    public function search2Action(Request $request, ProduitRepository $produitRepository, CategorieRepository $categorieRepository, MarqueRepository $marqueRepository)
    {
        $produitsFeatured = $produitRepository->findBy(array('featured' => true));
        $marques = $marqueRepository->findAll();
        $categories = $categorieRepository->findAll();

        $data = $request->request->get('search-name2');
        $res = $produitRepository->search($data);
        return $this->render('front/produit/search.html.twig', array(
                'res' => $res,
                'categories' => $categories,
                'marques' => $marques,
                'produitsFeatured' => $produitsFeatured,)
        );
    }

    #[Route('/produit/filtrer', name: 'produit_filtrer', methods: ['GET'])]
    public function filtrerAction(Request $request, CategorieRepository $categorieRepository, MarqueRepository $marqueRepository, ProduitRepository $produitRepository)
    {
        $marques = $marqueRepository->findAll();
        $categories = $categorieRepository->findAll();
        $produitsFeatured = $produitRepository->findBy(array('featured' => true));

        $categories = $request->request->get('categ');
        $marques = $request->request->get('marq');
        $res = $produitRepository->searchByFilter($categories, $marques);
        return $this->render('front/produit/index.html.twig', array(
                'res' => $res,
                'produitsFeatured' => $produitsFeatured,
                'categories' => $categories,
                'marques' => $marques,
            )
        );
    }
}
