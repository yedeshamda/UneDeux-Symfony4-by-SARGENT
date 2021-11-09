<?php

namespace App\Service\Parametre;

use App\Repository\ParametreRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Parametre;

class ParametreService
{
    private ParametreRepository $parametreRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(ParametreRepository $parametreRepository, EntityManagerInterface $entityManager)
    {
        $this->parametreRepository = $parametreRepository;
        $this->entityManager = $entityManager;
    }

    public function getFacebook()
    {
        $fb = $this->parametreRepository->findOneBy(['nom' => 'FACEBOOK']);
        if ($fb) {
            return $fb->getValeur();
        } else {
            $fb = new Parametre();
            $fb->setNom('FACEBOOK');
            $fb->setValeur('https://www.facebook.com/MATEB-824614960885270');
            $this->entityManager->persist($fb);
            $this->entityManager->flush();
            return $fb->getValeur();
        }
    }

    public function getInstagram()
    {
        $instagram = $this->parametreRepository->findOneBy(['nom' => 'INSTAGRAM']);
        if ($instagram) {
            return $instagram->getValeur();
        } else {
            $instagram = new Parametre();
            $instagram->setNom('INSTAGRAM');
            $instagram->setValeur('https://www.instagram.com/mateb_tunisie/?hl=fr');
            $this->entityManager->persist($instagram);
            $this->entityManager->flush();
            return $instagram->getValeur();
        }
    }

    public function getLinkedin()
    {
        $linkedin = $this->parametreRepository->findOneBy(['nom' => 'LINKEDIN']);
        if ($linkedin) {
            return $linkedin->getValeur();
        } else {
            $linkedin = new Parametre();
            $linkedin->setNom('LINKEDIN');
            $linkedin->setValeur('https://www.linkedin.com/company/mateb');
            $this->entityManager->persist($linkedin);
            $this->entityManager->flush();
            return $linkedin->getValeur();
        }
    }

    public function getYoutube()
    {
        $youtube = $this->parametreRepository->findOneBy(['nom' => 'YOUTUBE']);
        if ($youtube) {
            return $youtube->getValeur();
        } else {
            $youtube = new Parametre();
            $youtube->setNom('YOUTUBE');
            $youtube->setValeur('https://www.youtube.com/mateb');
            $this->entityManager->persist($youtube);
            $this->entityManager->flush();
            return $youtube->getValeur();
        }
    }

    public function getNum1()
    {
        $num1 = $this->parametreRepository->findOneBy(['nom' => 'NUM1']);
        if ($num1) {
            return $num1->getValeur();
        } else {
            $num1 = new Parametre();
            $num1->setNom('NUM1');
            $num1->setValeur('21672317925');
            $this->entityManager->persist($num1);
            $this->entityManager->flush();
            return $num1->getValeur();
        }
    }

    public function getNum2()
    {
        $num2 = $this->parametreRepository->findOneBy(['nom' => 'NUM2']);
        if ($num2) {
            return $num2->getValeur();
        } else {
            $num2 = new Parametre();
            $num2->setNom('NUM2');
            $num2->setValeur('21672317925');
            $this->entityManager->persist($num2);
            $this->entityManager->flush();
            return $num2->getValeur();
        }
    }

    public function getAdresse()
    {
        $adresse = $this->parametreRepository->findOneBy(['nom' => 'ADRESSE']);
        if ($adresse) {
            return $adresse->getValeur();
        } else {
            $adresse = new Parametre();
            $adresse->setNom('ADRESSE');
            $adresse->setValeur(' GP1 Birbouregba 8042 Hammamet. Hammamet, Tunisia');
            $this->entityManager->persist($adresse);
            $this->entityManager->flush();
            return $adresse->getValeur();
        }
    }

    public function getVille()
    {
        $ville = $this->parametreRepository->findOneBy(['nom' => 'VILLE']);
        if ($ville) {
            return $ville->getValeur();
        } else {
            $ville = new Parametre();
            $ville->setNom('VILLE');
            $ville->setValeur('Hammamet');
            $this->entityManager->persist($ville);
            $this->entityManager->flush();
            return $ville->getValeur();
        }
    }

    public function getEmail()
    {
        $email = $this->parametreRepository->findOneBy(['nom' => 'EMAIL']);
        if ($email) {
            return $email->getValeur();
        } else {
            $email = new Parametre();
            $email->setNom('EMAIL');
            $email->setValeur('matebry2@gmail.com');
            $this->entityManager->persist($email);
            $this->entityManager->flush();
            return $email->getValeur();
        }
    }

    public function getJourDebut()
    {
        $jourDebut = $this->parametreRepository->findOneBy(['nom' => 'JourDebut']);
        if ($jourDebut) {
            return $jourDebut->getValeur();
        } else {
            $jourDebut = new Parametre();
            $jourDebut->setNom('JourDebut');
            $jourDebut->setValeur('lundi');
            $this->entityManager->persist($jourDebut);
            $this->entityManager->flush();
            return $jourDebut->getValeur();
        }
    }

    public function getJourFin()
    {
        $jourFin = $this->parametreRepository->findOneBy(['nom' => 'JourFin']);
        if ($jourFin) {
            return $jourFin->getValeur();
        } else {
            $jourFin = new Parametre();
            $jourFin->setNom('JourFin');
            $jourFin->setValeur('samedi');
            $this->entityManager->persist($jourFin);
            $this->entityManager->flush();
            return $jourFin->getValeur();
        }
    }

    public function getHeureDebut()
    {
        $heureDebut = $this->parametreRepository->findOneBy(['nom' => 'HeureDebut']);
        if ($heureDebut) {
            return $heureDebut->getValeur();
        } else {
            $heureDebut = new Parametre();
            $heureDebut->setNom('HeureDebut');
            $heureDebut->setValeur('8h');
            $this->entityManager->persist($heureDebut);
            $this->entityManager->flush();
            return $heureDebut->getValeur();
        }
    }


    public function getHeureFin()
    {
        $heureFin = $this->parametreRepository->findOneBy(['nom' => 'HeureFin']);
        if ($heureFin) {
            return $heureFin->getValeur();
        } else {
            $heureFin = new Parametre();
            $heureFin->setNom('HeureFin');
            $heureFin->setValeur('19h');
            $this->entityManager->persist($heureFin);
            $this->entityManager->flush();
            return $heureFin->getValeur();
        }
    }

    public function getBienvenue()
    {
        $bienvenue = $this->parametreRepository->findOneBy(['nom' => 'BIENVENUE']);
        if ($bienvenue) {
            return $bienvenue->getValeur();
        } else {
            $bienvenue = new Parametre();
            $bienvenue->setNom('BIENVENUE');
            $bienvenue->setValeur('Au nom de toute l’équipe de MATEB, nous vous souhaitons la bienvenue sur votre site MATEB.TN et nous vous remercions d’avoir pris le temps de le visiter. Avant toute chose, ce qu’il faut savoir sur MATEB.tn :
            MATEB est 100 % tunisien. MATEB est conçu et créé pour le marché tunisien MATEB est le résultat d’une passion pour le matériel agricole et BTP. MATEB c’est beaucoup de choses à la fois.');
            $this->entityManager->persist($bienvenue);
            $this->entityManager->flush();
            return $bienvenue->getValeur();
        }
    }

    public function getMission()
    {
        $mission = $this->parametreRepository->findOneBy(['nom' => 'MISSION']);
        if ($mission) {
            return $mission->getValeur();
        } else {
            $mission = new Parametre();
            $mission->setNom('MISSION');
            $mission->setValeur('Au nom de toute l’équipe de MATEB, nous vous souhaitons la bienvenue sur votre site MATEB.TN et nous vous remercions d’avoir pris le temps de le visiter. Avant toute chose, ce qu’il faut savoir sur MATEB.tn :
            MATEB est 100 % tunisien. MATEB est conçu et créé pour le marché tunisien MATEB est le résultat d’une passion pour le matériel agricole et BTP. MATEB c’est beaucoup de choses à la fois.');
            $this->entityManager->persist($mission);
            $this->entityManager->flush();
            return $mission->getValeur();
        }
    }

    public function getImage1()
    {
        $image1 = $this->parametreRepository->findOneBy(['nom' => 'image1']);
        if ($image1) {
            return $image1->getValeur();
        } else {
            $image1 = new Parametre();
            $image1->setNom('image1');
            $image1->setValeur('');
            $this->entityManager->persist($image1);
            $this->entityManager->flush();
            return $image1->getValeur();
        }
    }

    public function getImage2()
    {
        $image2 = $this->parametreRepository->findOneBy(['nom' => 'image2']);
        if ($image2) {
            return $image2->getValeur();
        } else {
            $image2 = new Parametre();
            $image2->setNom('image2');
            $image2->setValeur('');
            $this->entityManager->persist($image2);
            $this->entityManager->flush();
            return $image2->getValeur();
        }
    }

    public function getBaniere1()
    {
        $baniere1 = $this->parametreRepository->findOneBy(['nom' => 'baniere1']);
        if ($baniere1) {
            return $baniere1->getValeur();
        } else {
            $baniere1 = new Parametre();
            $baniere1->setNom('baniere1');
            $baniere1->setValeur('');
            $this->entityManager->persist($baniere1);
            $this->entityManager->flush();
            return $baniere1->getValeur();
        }
    }

    public function getBaniere2()
    {
        $baniere2 = $this->parametreRepository->findOneBy(['nom' => 'baniere2']);
        if ($baniere2) {
            return $baniere2->getValeur();
        } else {
            $baniere2 = new Parametre();
            $baniere2->setNom('baniere2');
            $baniere2->setValeur('');
            $this->entityManager->persist($baniere2);
            $this->entityManager->flush();
            return $baniere2->getValeur();
        }
    }

    public function getBaniere3()
    {
        $baniere3 = $this->parametreRepository->findOneBy(['nom' => 'baniere3']);
        if ($baniere3) {
            return $baniere3->getValeur();
        } else {
            $baniere3 = new Parametre();
            $baniere3->setNom('baniere3');
            $baniere3->setValeur('');
            $this->entityManager->persist($baniere3);
            $this->entityManager->flush();
            return $baniere3->getValeur();
        }
    }

    public function getCatalogue()
    {
        $catalogue = $this->parametreRepository->findOneBy(['nom' => 'catalogue']);
        if ($catalogue) {
            return $catalogue->getValeur();
        } else {
            $catalogue = new Parametre();
            $catalogue->setNom('catalogue');
            $catalogue->setValeur('');
            $this->entityManager->persist($catalogue);
            $this->entityManager->flush();
            return $catalogue->getValeur();
        }
    }

}