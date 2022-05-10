<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRec", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrec;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="SujetRec", type="string", length=255, nullable=false)
     */
    private $sujetrec;

    /**
     * @var string|null
     *
     * @ORM\Column(name="libelleProduit", type="string", length=100, nullable=true)
     */
    private $libelleproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptionRec", type="string", length=255, nullable=false)
     */
    private $descriptionrec;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imgRec", type="string", length=255, nullable=true)
     */
    private $imgrec;

    /**
     * @var string
     *
     * @ORM\Column(name="StatusRec", type="string", length=255, nullable=false)
     */
    private $statusrec;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateRec", type="date", nullable=false)
     */
    private $daterec;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateTraitement", type="date", nullable=true)
     */
    private $datetraitement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NomPrenomUser", type="string", length=255, nullable=true)
     */
    private $nomprenomuser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EmailUser", type="string", length=255, nullable=true)
     */
    private $emailuser;

    /**
     * @var string
     *
     * @ORM\Column(name="Reponse", type="string", length=255, nullable=false)
     */
    private $reponse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likee;





    public function getIdrec(): ?int
    {
        return $this->idrec;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getSujetrec(): ?string
    {
        return $this->sujetrec;
    }

    public function setSujetrec(string $sujetrec): self
    {
        $this->sujetrec = $sujetrec;

        return $this;
    }

    public function getLibelleproduit(): ?string
    {
        return $this->libelleproduit;
    }

    public function setLibelleproduit(?string $libelleproduit): self
    {
        $this->libelleproduit = $libelleproduit;

        return $this;
    }

    public function getDescriptionrec(): ?string
    {
        return $this->descriptionrec;
    }

    public function setDescriptionrec(?string $descriptionrec): self
    {
        $this->descriptionrec = $descriptionrec;

        return $this;
    }

    public function getImgrec()
    {
        return $this->imgrec;
    }

    public function setImgrec( $imgrec): self
    {
        $this->imgrec = $imgrec;

        return $this;
    }

    public function getStatusrec(): ?string
    {
        return $this->statusrec;
    }

    public function setStatusrec(string $statusrec): self
    {
        $this->statusrec = $statusrec;

        return $this;
    }

    public function getDaterec(): ?\DateTimeInterface
    {
        return $this->daterec;
    }

    public function setDaterec(\DateTimeInterface $daterec): self
    {
        $this->daterec = $daterec;

        return $this;
    }

    public function getDatetraitement(): ?\DateTimeInterface
    {
        return $this->datetraitement;
    }

    public function setDatetraitement(?\DateTimeInterface $datetraitement): self
    {
        $this->datetraitement = $datetraitement;

        return $this;
    }

    public function getNomprenomuser(): ?string
    {
        return $this->nomprenomuser;
    }

    public function setNomprenomuser(?string $nomprenomuser): self
    {
        $this->nomprenomuser = $nomprenomuser;

        return $this;
    }

    public function getEmailuser(): ?string
    {
        return $this->emailuser;
    }

    public function setEmailuser(?string $emailuser): self
    {
        $this->emailuser = $emailuser;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getLikee(): ?int
    {
        return $this->likee;
    }

    public function setLikee(?int $likee): self
    {
        $this->likee = $likee;

        return $this;
    }






}
