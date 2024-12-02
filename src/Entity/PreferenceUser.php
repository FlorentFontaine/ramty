<?php

namespace App\Entity;

use App\Repository\PreferenceUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PreferenceUserRepository::class)]
class PreferenceUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $dark_mode = null;

    #[ORM\OneToOne(inversedBy: 'preferenceUser', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isDarkMode(): ?bool
    {
        return $this->dark_mode;
    }

    public function setDarkMode(bool $dark_mode): static
    {
        $this->dark_mode = $dark_mode;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
