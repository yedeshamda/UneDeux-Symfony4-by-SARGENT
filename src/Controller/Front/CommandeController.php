<?php

namespace App\Controller\Front;

use App\Entity\Commande;
use App\Entity\Livraison;
use App\Repository\CommandeRepository;
use App\Repository\LivraisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_mes_commandes')]
    public function mesCommandes(Request $request, CommandeRepository $commandeRepository): Response
    {
        $user = $this->getUser();
        $commandes = $commandeRepository->findByClientId($user->getId());
        return $this->render('front/commande/index.html.twig', [
            'commandes' => $commandes
        ]);
    }
    /**
     * @Route("/commande/changerEtat/{id}", name="commande_changer_etat", methods={"POST"})
     */
    public function activate(Commande $commande, CommandeRepository $commandeRepository): Response
    {
        $commandeRepository->changeEtat($commande);

        if ($commande->getEtat() == "En cours") {
            $msg = "Commande en cours";
        } else {
            $msg = "Commande Livrée";
        }
        $response = new Response(json_encode($msg));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
