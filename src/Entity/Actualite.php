<?php

namespace App\Entity;

use App\Repository\ActualiteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ActualiteRepository::class)
 */
class Actualite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */


    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message=" this field is required ")
     */
    private $titre_article;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message=" this field is required ")
     */
    private $type_sport;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message=" this field is required ")
     */
    private $contu_article;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message=" this field is required ")
     */
    private $video;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $jaime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $jaimepas;
    /**
     * @ORM\ManyToOne(targetEntity=Commentaire::class, inversedBy="Actualite")
     */
    private $Commentaire;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreArticle(): ?string
    {
        return $this->titre_article;
    }

    public function setTitreArticle(string $titre_article): self
    {
        $this->titre_article = $titre_article;

        return $this;
    }

    public function getTypeSport(): ?string
    {
        return $this->type_sport;
    }

    public function setTypeSport(string $type_sport): self
    {
        $this->type_sport = $type_sport;

        return $this;
    }

    public function getContuArticle(): ?string
    {
        return $this->contu_article;
    }

    public function setContuArticle(string $contu_article): self
    {
        $this->contu_article = $contu_article;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getJaime(): ?int
    {
        return $this->jaime;
    }

    public function setJaime(?int $jaime): self
    {
        $this->jaime = $jaime;

        return $this;
    }

    public function getJaimepas(): ?int
    {
        return $this->jaimepas;
    }

    public function setJaimepas(?int $jaimepas): self
    {
        $this->jaimepas = $jaimepas;

        return $this;
    }
    public function getCommentaire(): ?Commentaire
    {
        return $this->Commentaire;
    }

    public function setCommentaire(?Commentaire $Commentaire): self
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }
}
