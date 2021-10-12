<?php

namespace App\Entity;

use App\Repository\ParametreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParametreRepository::class)
 */
class Parametre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $tel1;

    /**
     * @ORM\Column(type="integer")
     */
    private $tel2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fb;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $youtube;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $linkedin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $instagram;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jourdebut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jourfin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $heuredebut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $heurefin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTel1(): ?int
    {
        return $this->tel1;
    }

    public function setTel1(int $tel1): self
    {
        $this->tel1 = $tel1;

        return $this;
    }

    public function getTel2(): ?int
    {
        return $this->tel2;
    }

    public function setTel2(int $tel2): self
    {
        $this->tel2 = $tel2;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFb(): ?string
    {
        return $this->fb;
    }

    public function setFb(string $fb): self
    {
        $this->fb = $fb;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getJourdebut(): ?string
    {
        return $this->jourdebut;
    }

    public function setJourdebut(string $jourdebut): self
    {
        $this->jourdebut = $jourdebut;

        return $this;
    }

    public function getJourfin(): ?string
    {
        return $this->jourfin;
    }

    public function setJourfin(string $jourfin): self
    {
        $this->jourfin = $jourfin;

        return $this;
    }

    public function getHeuredebut(): ?string
    {
        return $this->heuredebut;
    }

    public function setHeuredebut(string $heuredebut): self
    {
        $this->heuredebut = $heuredebut;

        return $this;
    }

    public function getHeurefin(): ?string
    {
        return $this->heurefin;
    }

    public function setHeurefin(string $heurefin): self
    {
        $this->heurefin = $heurefin;

        return $this;
    }
}
