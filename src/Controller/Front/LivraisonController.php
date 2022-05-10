<?php

namespace App\Controller\Front;

use App\Entity\Livraison;
use App\Repository\LivraisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivraisonController extends AbstractController
{
    /**
     * @Route("/livraison", name="app_mes_livraisons", methods={"GET"})
     */
    public function mesLivraisons(Request $request, LivraisonRepository $livraisonRepository): Response
    {
        $user = $this->getUser();
        $livraisons = $livraisonRepository->findByLivreurId($user->getId());
        return $this->render('front/livraison/index.html.twig', [
            'livraisons' => $livraisons
        ]);
    }
    /**
     * @Route("/livraison/changerEtat/{id}", name="livraison_changer_etat", methods={"POST"})
     */
    public function activate(Livraison $livraison, LivraisonRepository $livraisonRepository): Response
    {
        $livraisonRepository->changeEtat($livraison);

        if ($livraison->getEtat() == "En cours") {
            $msg = "Livraison en cours";
        } else {
            $msg = "Livraison Livrée";
        }
        $response = new Response(json_encode($msg));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
