<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @Vich\Uploadable
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
     * @ORM\Column(type="text",nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $datecreation;

    /**
     * @Vich\UploadableField(mapping="produits", fileNameProperty="imageName")
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string",nullable=true)
     *
     * @var string|null
     */
    private $imageName;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    /**
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(type="string", length=255,unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text",nullable=true)
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
     * @ORM\ManyToMany(targetEntity=FicheTech::class, inversedBy="produits")
     */
    private $fichetech;

    /**
     * @ORM\ManyToMany(targetEntity=Images::class, inversedBy="produits")
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Devis::class, mappedBy="produits")
     */
    private $devis;

    public function __construct()
    {
        $this->fichetech = new ArrayCollection();
        $this->image = new ArrayCollection();
        $this->datecreation=new \DateTimeImmutable();
        $this->devis = new ArrayCollection();
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

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getDevis(): Collection
    {
        return $this->devis;
    }

    public function addDevi(Devis $devi): self
    {
        if (!$this->devis->contains($devi)) {
            $this->devis[] = $devi;
            $devi->addProduit($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devis->removeElement($devi)) {
            $devi->removeProduit($this);
        }

        return $this;
    }
}
