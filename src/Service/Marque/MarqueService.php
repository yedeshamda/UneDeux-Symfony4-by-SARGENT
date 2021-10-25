<?php

namespace App\Service\Marque;

use App\Repository\MarqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Marque;

class MarqueService
{
    private MarqueRepository $marqueRepository;

    public function __construct(MarqueRepository $marqueRepository)
    {
        $this->marqueRepository = $marqueRepository;
    }

    public function getNom()
    {
        $marques = $this->marqueRepository->findAll();
        foreach($marques as $marque)
        {
            $nom = $marque->getNom();
        }
        return $nom;
    }
}