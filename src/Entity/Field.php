<?php

namespace App\Entity;

use App\Repository\FieldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FieldRepository::class)]
class Field
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fields')]
    private ?Research $researches = null;

    #[ORM\ManyToOne(inversedBy: 'fields')]
    private ?ConfigResearch $config = null;

    #[ORM\ManyToMany(targetEntity: Tool::class, inversedBy: 'fields')]
    private Collection $tools;

    #[ORM\ManyToMany(targetEntity: Criteria::class, inversedBy: 'fields')]
    private Collection $criteriums;

    #[ORM\ManyToMany(targetEntity: Sector::class, inversedBy: 'fields')]
    private Collection $sectors;

    public function __construct()
    {
        $this->tools = new ArrayCollection();
        $this->criteriums = new ArrayCollection();
        $this->sectors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResearches(): ?Research
    {
        return $this->researches;
    }

    public function setResearches(?Research $researches): static
    {
        $this->researches = $researches;

        return $this;
    }

    public function getConfig(): ?ConfigResearch
    {
        return $this->config;
    }

    public function setConfig(?ConfigResearch $config): static
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return Collection<int, Tool>
     */
    public function getTools(): Collection
    {
        return $this->tools;
    }

    public function addTool(Tool $tool): static
    {
        if (!$this->tools->contains($tool)) {
            $this->tools->add($tool);
        }

        return $this;
    }

    public function removeTool(Tool $tool): static
    {
        $this->tools->removeElement($tool);

        return $this;
    }

    /**
     * @return Collection<int, Criteria>
     */
    public function getCriteriums(): Collection
    {
        return $this->criteriums;
    }

    public function addCriterium(Criteria $criterium): static
    {
        if (!$this->criteriums->contains($criterium)) {
            $this->criteriums->add($criterium);
        }

        return $this;
    }

    public function removeCriterium(Criteria $criterium): static
    {
        $this->criteriums->removeElement($criterium);

        return $this;
    }

    /**
     * @return Collection<int, Sector>
     */
    public function getSectors(): Collection
    {
        return $this->sectors;
    }

    public function addSector(Sector $sector): static
    {
        if (!$this->sectors->contains($sector)) {
            $this->sectors->add($sector);
        }

        return $this;
    }

    public function removeSector(Sector $sector): static
    {
        $this->sectors->removeElement($sector);

        return $this;
    }
}
