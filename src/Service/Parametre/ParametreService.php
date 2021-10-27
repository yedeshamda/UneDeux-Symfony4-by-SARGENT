<?php

namespace App\Service\Parametre;
use App\Repository\ParametreRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Parametre;

class ParametreService
{
    private ParametreRepository $parametreRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(ParametreRepository $parametreRepository,EntityManagerInterface $entityManager)
    {
        $this->parametreRepository = $parametreRepository;
        $this->entityManager = $entityManager;
    }

    public function getFacebook(){
        $fb=$this->parametreRepository->findOneBy(['nom'=>'FACEBOOK']);
        if($fb)
        {
            return $fb->getValeur();
        }
        else
        {
            $fb=new Parametre();
            $fb->setNom('FACEBOOK');
            $fb->setValeur('https://www.facebook.com/MATEB-824614960885270');
            $this->entityManager->persist($fb);
            $this->entityManager->flush();
            return $fb->getValeur();
        }
    }
    public function getInstagram(){
        $instagram=$this->parametreRepository->findOneBy(['nom'=>'INSTAGRAM']);
        if($instagram)
        {
            return $instagram->getValeur();
        }
        else
        {
            $instagram=new Parametre();
            $instagram->setNom('INSTAGRAM');
            $instagram->setValeur('https://www.instagram.com/mateb_tunisie/?hl=fr');
            $this->entityManager->persist($instagram);
            $this->entityManager->flush();
            return $instagram->getValeur();
        }
    }
    public function getLinkedin(){
        $linkedin=$this->parametreRepository->findOneBy(['nom'=>'LINKEDIN']);
        if($linkedin)
        {
            return $linkedin->getValeur();
        }
        else
        {
            $linkedin=new Parametre();
            $linkedin->setNom('LINKEDIN');
            $linkedin->setValeur('https://www.linkedin.com/company/mateb');
            $this->entityManager->persist($linkedin);
            $this->entityManager->flush();
            return $linkedin->getValeur();
        }
    }

    public function getYoutube(){
        $youtube=$this->parametreRepository->findOneBy(['nom'=>'YOUTUBE']);
        if($youtube)
        {
            return $youtube->getValeur();
        }
        else
        {
            $youtube=new Parametre();
            $youtube->setNom('YOUTUBE');
            $youtube->setValeur('https://www.youtube.com/mateb');
            $this->entityManager->persist($youtube);
            $this->entityManager->flush();
            return $youtube->getValeur();
        }
    }
    public function getNum1(){
        $num1=$this->parametreRepository->findOneBy(['nom'=>'NUM1']);
        if($num1)
        {
            return $num1->getValeur();
        }
        else
        {
            $num1=new Parametre();
            $num1->setNom('NUM1');
            $num1->setValeur('21672317925');
            $this->entityManager->persist($num1);
            $this->entityManager->flush();
            return $num1->getValeur();
        }
    }
    public function getNum2(){
        $num2=$this->parametreRepository->findOneBy(['nom'=>'NUM2']);
        if($num2)
        {
            return $num2->getValeur();
        }
        else
        {
            $num2=new Parametre();
            $num2->setNom('NUM2');
            $num2->setValeur('21672317925');
            $this->entityManager->persist($num2);
            $this->entityManager->flush();
            return $num2->getValeur();
        }
    }

    public function getAdresse(){
        $adresse=$this->parametreRepository->findOneBy(['nom'=>'ADRESSE']);
        if($adresse)
        {
            return $adresse->getValeur();
        }
        else
        {
            $adresse=new Parametre();
            $adresse->setNom('ADRESSE');
            $adresse->setValeur(' GP1 Birbouregba 8042 Hammamet. Hammamet, Tunisia');
            $this->entityManager->persist($adresse);
            $this->entityManager->flush();
            return $adresse->getValeur();
        }
    }

    public function getVille(){
        $ville=$this->parametreRepository->findOneBy(['nom'=>'VILLE']);
        if($ville)
        {
            return $ville->getValeur();
        }
        else
        {
            $ville=new Parametre();
            $ville->setNom('VILLE');
            $ville->setValeur('Hammamet');
            $this->entityManager->persist($ville);
            $this->entityManager->flush();
            return $ville->getValeur();
        }
    }

    public function getEmail(){
        $email=$this->parametreRepository->findOneBy(['nom'=>'EMAIL']);
        if($email)
        {
            return $email->getValeur();
        }
        else
        {
            $email=new Parametre();
            $email->setNom('EMAIL');
            $email->setValeur('matebry2@gmail.com');
            $this->entityManager->persist($email);
            $this->entityManager->flush();
            return $email->getValeur();
        }
    }

    public function getJourDebut(){
        $jourDebut=$this->parametreRepository->findOneBy(['nom'=>'JourDebut']);
        if($jourDebut)
        {
            return $jourDebut->getValeur();
        }
        else
        {
            $jourDebut=new Parametre();
            $jourDebut->setNom('JourDebut');
            $jourDebut->setValeur('lundi');
            $this->entityManager->persist($jourDebut);
            $this->entityManager->flush();
            return $jourDebut->getValeur();
        }
    }

    public function getJourFin(){
        $jourFin=$this->parametreRepository->findOneBy(['nom'=>'JourFin']);
        if($jourFin)
        {
            return $jourFin->getValeur();
        }
        else
        {
            $jourFin=new Parametre();
            $jourFin->setNom('JourFin');
            $jourFin->setValeur('samedi');
            $this->entityManager->persist($jourFin);
            $this->entityManager->flush();
            return $jourFin->getValeur();
        }
    }

    public function getHeureDebut(){
        $heureDebut=$this->parametreRepository->findOneBy(['nom'=>'HeureDebut']);
        if($heureDebut)
        {
            return $heureDebut->getValeur();
        }
        else
        {
            $heureDebut=new Parametre();
            $heureDebut->setNom('HeureDebut');
            $heureDebut->setValeur('8h');
            $this->entityManager->persist($heureDebut);
            $this->entityManager->flush();
            return $heureDebut->getValeur();
        }
    }


    public function getHeureFin(){
        $heureFin=$this->parametreRepository->findOneBy(['nom'=>'HeureFin']);
        if($heureFin)
        {
            return $heureFin->getValeur();
        }
        else
        {
            $heureFin=new Parametre();
            $heureFin->setNom('HeureFin');
            $heureFin->setValeur('19h');
            $this->entityManager->persist($heureFin);
            $this->entityManager->flush();
            return $heureFin->getValeur();
        }
    }

}