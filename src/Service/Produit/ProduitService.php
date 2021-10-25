<?php

namespace App\Service\Produit;

use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Produit;

class ProduitService
{
    private ProduitRepository $produitRepository;

    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }

    public function getNom()
    {
        $produits = $this->produitRepository->findAll();
        foreach($produits as $produit)
        {
            $nom = $produit->getNom();
        }
        return $nom;
    }
}