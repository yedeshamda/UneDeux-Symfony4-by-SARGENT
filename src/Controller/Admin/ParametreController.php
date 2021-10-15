<?php

namespace App\Controller\Admin;

use App\Entity\Parametre;
use App\Form\ParametreType;
use App\Repository\ParametreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class ParametreController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/parametre', name: 'parametre', methods: ['GET', 'POST'])]
    public function new(Request $request, ParametreRepository $parametreRepository): Response
    {
        $facebook = $parametreRepository->findOneBy(['nom' => 'FACEBOOK']);
        $instagram = $parametreRepository->findOneBy(['nom' => 'INSTAGRAM']);
        $youtube = $parametreRepository->findOneBy(['nom' => 'YOUTUBE']);
        $linkedin = $parametreRepository->findOneBy(['nom' => 'LINKEDIN']);
        $tel1 = $parametreRepository->findOneBy(['nom' => 'NUM1']);
        $tel2 = $parametreRepository->findOneBy(['nom' => 'NUM2']);
        $adresse = $parametreRepository->findOneBy(['nom' => 'ADRESSE']);
        $ville = $parametreRepository->findOneBy(['nom' => 'VILLE']);
        $email = $parametreRepository->findOneBy(['nom' => 'EMAIL']);
        $jourdebut = $parametreRepository->findOneBy(['nom' => 'JourDebut']);
        $jourfin = $parametreRepository->findOneBy(['nom' => 'JourFin']);
        $heuredebut = $parametreRepository->findOneBy(['nom' => 'HeureDebut']);
        $heurefin = $parametreRepository->findOneBy(['nom' => 'HeureFin']);
        if (!$instagram) {
            $instagram = new Parametre();
            $instagram->setNom('INSTAGRAM')->setValeur($request->request->get('INSTAGRAM'));
        }
        if (!$facebook) {
            $facebook = new Parametre();
            $facebook->setNom('FACEBOOK')->setValeur($request->request->get('FACEBOOK'));
        }
        if (!$youtube) {
            $youtube = new Parametre();
            $youtube->setNom('YOUTUBE')->setValeur($request->request->get('YOUTUBE'));
        }

        if (!$linkedin) {
            $linkedin = new Parametre();
            $linkedin->setNom('LINKEDIN')->setValeur($request->request->get('LINKEDIN'));
        }
        if (!$tel1) {
            $tel1 = new Parametre();
            $tel1->setNom('NUM1')->setValeur($request->request->get('NUM1'));
        }

        if (!$tel2) {
            $tel2 = new Parametre();
            $tel2->setNom('NUM2')->setValeur($request->request->get('NUM2'));
        }
        if (!$adresse) {
            $adresse = new Parametre();
            $adresse->setNom('ADRESSE')->setValeur($request->request->get('ADRESSE'));
        }
        if (!$ville) {
            $ville = new Parametre();
            $ville->setNom('VILLE')->setValeur($request->request->get('VILLE'));
        }
        if (!$email) {
            $email = new Parametre();
            $email->setNom('EMAIL')->setValeur($request->request->get('EMAIL'));
        }
        if (!$jourdebut) {
            $jourdebut = new Parametre();
            $jourdebut->setNom('JourDebut')->setValeur($request->request->get('JourDebut'));
        }
        if (!$jourfin) {
            $jourfin = new Parametre();
            $jourfin->setNom('JourFin')->setValeur($request->request->get('JourFin'));
        }
        if (!$heuredebut) {
            $heuredebut = new Parametre();
            $heuredebut->setNom('HeureDebut')->setValeur($request->request->get('HeureDebut'));
        }

        if (!$heurefin) {
            $heurefin = new Parametre();
            $heurefin->setNom('HeureFin')->setValeur($request->request->get('HeureFin'));
        }


        if ($request->isMethod('POST')) {
            if ($facebook) {
                $facebook->setValeur($request->request->get('FACEBOOK'));
            }

            if ($instagram) {
                $instagram->setValeur($request->request->get('INSTAGRAM'));
            }

            if ($youtube) {
                $youtube->setValeur($request->request->get('YOUTUBE'));
            }

            if ($linkedin) {
                $linkedin->setValeur($request->request->get('LINKEDIN'));
            }
            if ($tel1) {
                $tel1->setValeur($request->request->get('NUM1'));
            }

            if ($tel2) {
                $tel2->setValeur($request->request->get('NUM2'));
            }
            if ($adresse) {
                $adresse->setValeur($request->request->get('ADRESSE'));
            }
            if ($ville) {
                $ville->setValeur($request->request->get('VILLE'));
            }
            if ($email) {
                $email->setValeur($request->request->get('EMAIL'));
            }
            if ($jourdebut) {
                $jourdebut->setValeur($request->request->get('JourDebut'));
            }
            if ($jourfin) {
                $jourfin->setValeur($request->request->get('JourFin'));
            }
            if ($heuredebut) {
                $heuredebut->setValeur($request->request->get('HeureDebut'));
            }

            if ($heurefin) {
                $heurefin->setValeur($request->request->get('HeureFin'));
            }
        }

        $this->entityManager->persist($facebook);
        $this->entityManager->persist($instagram);
        $this->entityManager->persist($youtube);
        $this->entityManager->persist($linkedin);
        $this->entityManager->persist($tel1);
        $this->entityManager->persist($tel2);
        $this->entityManager->persist($adresse);
        $this->entityManager->persist($ville);
        $this->entityManager->persist($email);
        $this->entityManager->persist($jourdebut);
        $this->entityManager->persist($jourfin);
        $this->entityManager->persist($heuredebut);
        $this->entityManager->persist($heurefin);


        $this->entityManager->flush();
        return $this->render('parametre/new.html.twig', [
            'facebook' => $facebook->getValeur(),
            'instagram' => $instagram->getValeur(),
            'youtube' => $youtube->getValeur(),
            'linkedin' => $linkedin->getValeur(),
            'tel1' => $tel1->getValeur(),
            'tel2' => $tel2->getValeur(),
            'adresse' => $adresse->getValeur(),
            'ville' => $ville->getValeur(),
            'email' => $email->getValeur(),
            'jourdebut' => $jourdebut->getValeur(),
            'jourfin' => $jourfin->getValeur(),
            'heuredebut' => $heuredebut->getValeur(),
            'heurefin' => $heurefin->getValeur(),
        ]);
    }


}