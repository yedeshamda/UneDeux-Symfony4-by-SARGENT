<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 * @Vich\Uploadable
 */
class Video
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
     * @Vich\UploadableField(mapping="videos", fileNameProperty="videoName")
     * @var File|null
     */
    private $videoFile;

    /**
     * @ORM\Column(type="string",nullable=true)
     *
     * @var string|null
     */
    private $videoName;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="date")
     */
    private $datecreation;


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

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function __construct()
    {
        $this->datecreation=new \DateTimeImmutable();
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $videoFile
     */
    public function setVideoFile(?File $videoFile = null): void
    {
        $this->videoFile = $videoFile;
        if (null !== $videoFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getVideoFile(): ?File
    {
        return $this->videoFile;
    }

    public function setVideoName(?string $videoName): void
    {
        $this->videoName = $videoName;
    }

    public function getVideoName(): ?string
    {
        return $this->videoName;
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

}
