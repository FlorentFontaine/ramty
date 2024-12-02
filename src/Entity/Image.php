<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'image_cover', cascade: ['persist', 'remove'])]
    private ?User $cover_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCoverUser(): ?User
    {
        return $this->cover_user;
    }

    public function setCoverUser(?User $cover_user): static
    {
        // unset the owning side of the relation if necessary
        if ($cover_user === null && $this->cover_user !== null) {
            $this->cover_user->setImageCover(null);
        }

        // set the owning side of the relation if necessary
        if ($cover_user !== null && $cover_user->getImageCover() !== $this) {
            $cover_user->setImageCover($this);
        }

        $this->cover_user = $cover_user;

        return $this;
    }
}
