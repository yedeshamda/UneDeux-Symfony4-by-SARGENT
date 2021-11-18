<?php

namespace App\Controller\Front;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/{_locale<en|fr>}', name: 'front_')]
class CatalogueController extends AbstractController
{
    #[Route('/parametre/catalogue', name: 'parametre_catalogue', methods: ['GET','POST'])]
    public function new(Request $request,CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();
        return $this->renderForm('front/parametre/index_catalogue.html.twig', [
            'categories' => $categories,
        ]);
    }
}
