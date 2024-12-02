<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'module', targetEntity: CompagnyModule::class, orphanRemoval: true)]
    private Collection $compagnyModules;

    public function __construct()
    {
        $this->compagnyModules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
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

    /**
     * @return Collection<int, CompagnyModule>
     */
    public function getCompagnyModules(): Collection
    {
        return $this->compagnyModules;
    }

    public function addCompagnyModule(CompagnyModule $compagnyModule): static
    {
        if (!$this->compagnyModules->contains($compagnyModule)) {
            $this->compagnyModules->add($compagnyModule);
            $compagnyModule->setModule($this);
        }

        return $this;
    }

    public function removeCompagnyModule(CompagnyModule $compagnyModule): static
    {
        if ($this->compagnyModules->removeElement($compagnyModule)) {
            // set the owning side to null (unless already changed)
            if ($compagnyModule->getModule() === $this) {
                $compagnyModule->setModule(null);
            }
        }

        return $this;
    }
}
