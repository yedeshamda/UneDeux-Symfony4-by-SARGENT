<?php

namespace App\Service\Categorie;

use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categorie;

class CategorieService
{
    private CategorieRepository $categorieRepository;

    public function __construct(CategorieRepository $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository;
    }

    public function getImage()
    {
        $categories = $this->categorieRepository->findAll();
        foreach($categories as $categorie)
        {
            $baniereImageFile = $categorie->getBaniereImageName();
        }
        return $baniereImageFile;
    }

    public function getTitre()
    {
        $categories = $this->categorieRepository->findAll();
        foreach($categories as $categorie)
        {
            $titre = $categorie->getTitre();
        }
        return $titre;
    }

/*    public function getDescripton()
    {
        $categories = $this->categorieRepository->findAll();
        foreach($categories as $categorie)
        {
            $descripton = $categorie->getDescription();
        }
        return $descripton;
    }*/
}