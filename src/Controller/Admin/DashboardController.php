<?php

namespace App\Controller\Admin;

use App\Repository\LivraisonRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/adminn", name="adminn")
 */
class DashboardController extends AbstractController
{
    /**
     *
     * @Route("/dashboard", name="dashboard")
     */
    public function index(UserRepository $userRepository, LivraisonRepository $livraisonRepository): Response
    {
        /*$admins = count($userRepository->getNumberOfUsersByRole("ADMIN"));
        $clients = count($userRepository->getNumberOfUsersByRole("CLIENT"));
        $livreurs = count($userRepository->getNumberOfUsersByRole("LIVREUR"));
        */

        $daily = count($livraisonRepository->findDaily());
        $monthly = count($livraisonRepository->findMonthly());
        $yearly = count($livraisonRepository->findYearly("2022"));

        $jan = count($livraisonRepository->findByMonth("1"));
        $feb = count($livraisonRepository->findByMonth("2"));
        $mar = count($livraisonRepository->findByMonth("3"));
        $apr = count($livraisonRepository->findByMonth("4"));
        $may = count($livraisonRepository->findByMonth("5"));
        $juin = count($livraisonRepository->findByMonth("6"));
        $jui = count($livraisonRepository->findByMonth("7"));
        $aout = count($livraisonRepository->findByMonth("8"));
        $sept = count($livraisonRepository->findByMonth("9"));
        $oct = count($livraisonRepository->findByMonth("10"));
        $nov = count($livraisonRepository->findByMonth("11"));
        $dec = count($livraisonRepository->findByMonth("12"));

        return $this->render('admin/dashboard/index.html.twig', [
            'daily' => $daily,
            'monthly' => $monthly,
            'yearly' => $yearly,
            'jan' => $jan,
            'feb' => $feb,
            'mar' => $mar,
            'apr' => $apr,
            'may' => $may,
            'juin' => $juin,
            'jui' => $jui,
            'aout' => $aout,
            'sept' => $sept,
            'oct' => $oct,
            'nov' => $nov,
            'dec' => $dec
        ]);
    }
}
