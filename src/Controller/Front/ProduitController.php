<?php

namespace App\Controller\Front;

use App\Entity\Devis;
use App\Entity\Produit;
use App\Form\DevisType;
use App\Form\ProduitType;
use App\Repository\CategorieRepository;
use App\Repository\MarqueRepository;
use App\Repository\ProduitRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/{_locale<en|fr>}', name: 'front_')]
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

    #[Route('/produitCategorie/{id}', name: 'produit_categorie_index', methods: ['GET','POST'])]
    public function indexCategorie(MarqueRepository $marqueRepository,int $id,Request $request, PaginatorInterface $paginator, ProduitRepository $produitRepository, CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();
        $marques = $marqueRepository->findAll();

        $categorie = $categorieRepository->find($id);
        $produitsByCategorie = $produitRepository->findBy(
            ['categorie' => [$categorie]],
        );


        $pagination = $paginator->paginate(
            $produitsByCategorie, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );

        return $this->render('front/produit/indexCategorie.html.twig', [
            'produitsByCategorie' => $pagination,
            'categories' => $categories,
            'categorie' => $categorie,
            'marques' => $marques,
        ]);
    }

    #[Route('/produitMarque/{id}', name: 'produit_marque_index', methods: ['GET','POST'])]
    public function indexMarque(MarqueRepository $marqueRepository,int $id,Request $request, PaginatorInterface $paginator, ProduitRepository $produitRepository, CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();
        $marques = $marqueRepository->findAll();

        $categorie = $categorieRepository->find($id);
        $marque = $marqueRepository->find($id);
        $produitsByCategorie = $produitRepository->findBy(
            ['categorie' => [$categorie]],
        );

        $produitsByMarque = $produitRepository->findBy(
            ['marque' => [$marque]],
        );


        $pagination = $paginator->paginate(
            $produitsByMarque, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );

        return $this->render('front/produit/indexMarque.html.twig', [
            'produitsByCategorie' => $produitsByCategorie,
            'categories' => $categories,
            'categorie' => $categorie,
            'marques' => $marques,
            'produitsByMarque' => $pagination,
        ]);
    }

    #[Route('/produit/show/{id}', name: 'produit_show', methods: ['POST','GET'])]
    public function show(MarqueRepository $marqueRepository,Request $request, int $id, ProduitRepository $produitRepository, CategorieRepository $categorieRepository): Response
    {
        $marques = $marqueRepository->findAll();
        $categories = $categorieRepository->findAll();
        $produitsFeatured = $produitRepository->findBy(array('featured' => true));
        $produit = $produitRepository->find($id);
        $produits = $produitRepository->findBy(
            ['categorie' => [$produit->getCategorie()]],
        );

        $devi = new Devis();
        $devi->addProduit($produit);
        $form = $this->createForm(DevisType::class, $devi);
        $form->handleRequest($request);

        //Devis
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($devi);
            $entityManager->flush();

            return $this->redirectToRoute('front_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/produit/show.html.twig', [
            'categories' => $categories,
            'produit' => $produit,
            'produits' => $produits,
            'produitsFeatured' => $produitsFeatured,
            //Devis
            'devi' => $devi,
            'marques' => $marques,
            'form' => $form->createView(),
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

    #[Route('/produit/download/{file}', name: 'produit_download_file', methods: ['GET'])]
    public function downloadFileAction(string $file){
        $response = new BinaryFileResponse('images/ficheTechnique/' . $file);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT,$file);
        return $response;
    }
}
