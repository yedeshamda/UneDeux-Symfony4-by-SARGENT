<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/{_locale<en|fr>}', name: 'front_')]
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard_')]
    public function index(): Response
    {
        return $this->render('front/dashboard/index.html.twig', [
         ]);
    }
}
