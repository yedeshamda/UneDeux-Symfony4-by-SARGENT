<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $datecreation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptiontech;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="produits")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="produits")
     */
    private $marque;

    /**
     * @ORM\ManyToOne(targetEntity=Devis::class, inversedBy="produits")
     */
    private $devis;

    /**
     * @ORM\ManyToMany(targetEntity=FicheTech::class, inversedBy="produits")
     */
    private $fichetech;

    /**
     * @ORM\ManyToMany(targetEntity=Images::class, inversedBy="produits")
     */
    private $image;

    public function __construct()
    {
        $this->fichetech = new ArrayCollection();
        $this->image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescriptiontech(): ?string
    {
        return $this->descriptiontech;
    }

    public function setDescriptiontech(string $descriptiontech): self
    {
        $this->descriptiontech = $descriptiontech;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getDevis(): ?Devis
    {
        return $this->devis;
    }

    public function setDevis(?Devis $devis): self
    {
        $this->devis = $devis;

        return $this;
    }

    /**
     * @return Collection|FicheTech[]
     */
    public function getFichetech(): Collection
    {
        return $this->fichetech;
    }

    public function addFichetech(FicheTech $fichetech): self
    {
        if (!$this->fichetech->contains($fichetech)) {
            $this->fichetech[] = $fichetech;
        }

        return $this;
    }

    public function removeFichetech(FicheTech $fichetech): self
    {
        $this->fichetech->removeElement($fichetech);

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Images $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        $this->image->removeElement($image);

        return $this;
    }
}
