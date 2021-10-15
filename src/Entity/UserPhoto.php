<?php

namespace App\Entity;

use App\Repository\UserPhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
/**
 * @ORM\Entity(repositoryClass=UserPhotoRepository::class)
 * @Vich\Uploadable
 */
class UserPhoto implements \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="users", fileNameProperty="photoName", size="photoSize")
     *
     * @var File
     */
    private $photoFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @var string
     */
    private $photoName;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     * @var integer
     */
    private $photoSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $photoFile
     */
    public function setPhotoFile(?File $photoFile = null): self
    {
        $this->photoFile = $photoFile;

        if (null !== $photoFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getPhotoFile(): ?File
    {
        return $this->photoFile;
    }

    public function setPhotoName(?string $photoName): self
    {
        $this->photoName = $photoName;
        return $this;
    }

    public function getPhotoName(): ?string
    {
        return $this->photoName;
    }

    public function setPhotoSize(?int $photoSize): self
    {
        $this->photoSize = $photoSize;
        return $this;
    }

    public function getPhotoSize(): ?int
    {
        return $this->photoSize;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->photoName,
            $this->photoSize,
            $this->updatedAt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->photoName,
            $this->photoSize,
            $this->updatedAt,
            ) = unserialize($serialized, array('allowed_classes' => false));
    }
}