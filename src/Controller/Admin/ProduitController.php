<?php

namespace App\Controller\Admin;

use App\Entity\FicheTech;
use App\Entity\Images;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class ProduitController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
     {
         $this->entityManager = $entityManager;
     }

    #[Route('/produit', name: 'produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('admin/produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    #[Route('/produit/new', name: 'produit_new', methods: ['GET','POST'])]
    public function new(Request $request,UploaderHelper $helper): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //Fiche Technique
            $fichestech=$request->files->get('produit')['fichetech'];
            if(!empty($fichestech))
            {
                foreach ($fichestech as $fiche)
                {
                    $name=$helper->uploadImage($fiche,'ficheTechnique');
                    $ficheTech=new FicheTech();
                    $ficheTech->setNom($name);
                    $produit->addFichetech($ficheTech);
                 }
            }

            //Images Multiples
            $images=$request->files->get('produit')['image'];
            if(!empty($images))
            {
                foreach ($images as $imagesmultiple)
                {
                    $imagesName=$helper->uploadImage($imagesmultiple,'imageMultiple');
                    $Images=new Images();
                    $Images->setNom($imagesName);
                    $produit->addImage($Images);
                }
            }

             $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('admin_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/produit/{id}', name: 'produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('admin/produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/produit/{id}/edit', name: 'produit_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Produit $produit): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/produit/{id}', name: 'produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
