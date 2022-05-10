<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=NotificationRepository::class)
 */
class Notification
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"notification"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"notification"})
     */
    private $message;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"notification"})
     */
    private $lecture;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="notifications")
     * @Groups({"notification"})
     */
    private $user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_creation;


    public function __construct()
    {
        $this->lecture = false;
        $this->user = new ArrayCollection();
        $this->date_creation=new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getLecture(): ?bool
    {
        return $this->lecture;
    }

    public function setLecture(bool $lecture): self
    {
        $this->lecture = $lecture;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(?\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

}
