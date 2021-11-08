<?php

namespace App\Controller\Front;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front', name: 'front_')]
class CatalogueController extends AbstractController
{
    #[Route('/catalogue', name: 'catalogue', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {

        return $this->renderForm('front/catalogue/index.html.twig', [
        ]);
    }
}
