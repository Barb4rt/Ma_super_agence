<?php

namespace App\Entity;

use App\Entity\Property;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PictureRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PictureRepository::class)
 * @Vich\Uploadable()
 */
class Picture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  
     */
    private $id;
    
    /**
     * @var File|null
     *@Assert\Image(
     *      mimeTypes="image/jpeg")
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     */

    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @ORM\ManyToOne(targetEntity=Property::class, inversedBy="pictures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $property;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): self
    {
        $this->property = $property;

        return $this;
    }

    /**
      * Get the value of imageFile
      */ 
      public function getImageFile()
      {
           return $this->imageFile;
      }
 
      /**
       * Set the value of imageFile
       *
       * @return  self
       */ 
      public function setImageFile($imageFile)
      {
           $this->imageFile = $imageFile;
           
      }
 
}
