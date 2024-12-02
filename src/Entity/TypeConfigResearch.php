<?php

namespace App\Entity;

use App\Repository\TypeConfigResearchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeConfigResearchRepository::class)]
class TypeConfigResearch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $operator = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: ConfigResearch::class, orphanRemoval: true)]
    private Collection $configResearch;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\ManyToOne(inversedBy: 'typeConfigResearch')]
    private ?Icon $icon = null;

    public function __construct()
    {
        $this->configResearch = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->operator ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOperator(): ?string
    {
        return $this->operator;
    }

    public function setOperator(string $operator): static
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * @return Collection<int, ConfigResearch>
     */
    public function getConfigResearch(): Collection
    {
        return $this->configResearch;
    }

    public function addConfigResearch(ConfigResearch $configResearch): static
    {
        if (!$this->configResearch->contains($configResearch)) {
            $this->configResearch->add($configResearch);
            $configResearch->setType($this);
        }

        return $this;
    }

    public function removeConfigResearch(ConfigResearch $configResearch): static
    {
        if ($this->configResearch->removeElement($configResearch)) {
            // set the owning side to null (unless already changed)
            if ($configResearch->getType() === $this) {
                $configResearch->setType(null);
            }
        }

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getIcon(): ?Icon
    {
        return $this->icon;
    }

    public function setIcon(?Icon $icon): static
    {
        $this->icon = $icon;

        return $this;
    }
}
