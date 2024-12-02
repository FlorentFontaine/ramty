<?php

namespace App\Entity;

use App\Repository\CompagnyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompagnyRepository::class)]
class Compagny
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Staff::class)]
    private Collection $staffs;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Event::class)]
    private Collection $Events;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Alert::class)]
    private Collection $Alerts;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Criteria::class)]
    private Collection $Criteriums;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Document::class)]
    private Collection $documents;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Address::class)]
    private Collection $addresses;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Candidacy::class)]
    private Collection $candidacies;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Research::class)]
    private Collection $researches;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Location::class)]
    private Collection $locations;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Sector::class)]
    private Collection $sectors;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Tool::class)]
    private Collection $tools;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Competence::class)]
    private Collection $competences;

    #[ORM\OneToOne(mappedBy: 'compagny', cascade: ['persist', 'remove'])]
    private ?Chat $chat = null;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Task::class, orphanRemoval: true)]
    private Collection $tasks;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deleted_at = null;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: CompagnyModule::class, orphanRemoval: true)]
    private Collection $compagnyModules;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->staffs = new ArrayCollection();
        $this->Events = new ArrayCollection();
        $this->Alerts = new ArrayCollection();
        $this->Criteriums = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->candidacies = new ArrayCollection();
        $this->researches = new ArrayCollection();
        $this->locations = new ArrayCollection();
        $this->sectors = new ArrayCollection();
        $this->tools = new ArrayCollection();
        $this->competences = new ArrayCollection();
        $this->tasks = new ArrayCollection();
        $this->compagnyModules = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }

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

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at ?? new \DateTimeImmutable();

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCompagny($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCompagny() === $this) {
                $user->setCompagny(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Staff>
     */
    public function getStaffs(): Collection
    {
        return $this->staffs;
    }

    public function addStaff(Staff $staff): static
    {
        if (!$this->staffs->contains($staff)) {
            $this->staffs->add($staff);
            $staff->setCompagny($this);
        }

        return $this;
    }

    public function removeStaff(Staff $staff): static
    {
        if ($this->staffs->removeElement($staff)) {
            // set the owning side to null (unless already changed)
            if ($staff->getCompagny() === $this) {
                $staff->setCompagny(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->Events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->Events->contains($event)) {
            $this->Events->add($event);
            $event->setCompagny($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->Events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getCompagny() === $this) {
                $event->setCompagny(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Alert>
     */
    public function getAlerts(): Collection
    {
        return $this->Alerts;
    }

    public function addAlert(Alert $alert): static
    {
        if (!$this->Alerts->contains($alert)) {
            $this->Alerts->add($alert);
            $alert->setCompagny($this);
        }

        return $this;
    }

    public function removeAlert(Alert $alert): static
    {
        if ($this->Alerts->removeElement($alert)) {
            // set the owning side to null (unless already changed)
            if ($alert->getCompagny() === $this) {
                $alert->setCompagny(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Criteria>
     */
    public function getCriteriums(): Collection
    {
        return $this->Criteriums;
    }

    public function addCriterium(Criteria $criterium): static
    {
        if (!$this->Criteriums->contains($criterium)) {
            $this->Criteriums->add($criterium);
            $criterium->setCompagny($this);
        }

        return $this;
    }

    public function removeCriterium(Criteria $criterium): static
    {
        if ($this->Criteriums->removeElement($criterium)) {
            // set the owning side to null (unless already changed)
            if ($criterium->getCompagny() === $this) {
                $criterium->setCompagny(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setCompagny($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): static
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getCompagny() === $this) {
                $document->setCompagny(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): static
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses->add($address);
            $address->setCompagny($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): static
    {
        if ($this->addresses->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getCompagny() === $this) {
                $address->setCompagny(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Candidacy>
     */
    public function getCandidacies(): Collection
    {
        return $this->candidacies;
    }

    public function addCandidacy(Candidacy $candidacy): static
    {
        if (!$this->candidacies->contains($candidacy)) {
            $this->candidacies->add($candidacy);
            $candidacy->setCompagny($this);
        }

        return $this;
    }

    public function removeCandidacy(Candidacy $candidacy): static
    {
        if ($this->candidacies->removeElement($candidacy)) {
            // set the owning side to null (unless already changed)
            if ($candidacy->getCompagny() === $this) {
                $candidacy->setCompagny(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Research>
     */
    public function getResearches(): Collection
    {
        return $this->researches;
    }

    public function addResearch(Research $research): static
    {
        if (!$this->researches->contains($research)) {
            $this->researches->add($research);
            $research->setCompagny($this);
        }

        return $this;
    }

    public function removeResearch(Research $research): static
    {
        if ($this->researches->removeElement($research)) {
            // set the owning side to null (unless already changed)
            if ($research->getCompagny() === $this) {
                $research->setCompagny(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): static
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setCompagny($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): static
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getCompagny() === $this) {
                $location->setCompagny(null);
            }
        }

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
            $sector->setCompagny($this);
        }

        return $this;
    }

    public function removeSector(Sector $sector): static
    {
        if ($this->sectors->removeElement($sector)) {
            // set the owning side to null (unless already changed)
            if ($sector->getCompagny() === $this) {
                $sector->setCompagny(null);
            }
        }

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
            $tool->setCompagny($this);
        }

        return $this;
    }

    public function removeTool(Tool $tool): static
    {
        if ($this->tools->removeElement($tool)) {
            // set the owning side to null (unless already changed)
            if ($tool->getCompagny() === $this) {
                $tool->setCompagny(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Competence>
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): static
    {
        if (!$this->competences->contains($competence)) {
            $this->competences->add($competence);
            $competence->setCompagny($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): static
    {
        if ($this->competences->removeElement($competence)) {
            // set the owning side to null (unless already changed)
            if ($competence->getCompagny() === $this) {
                $competence->setCompagny(null);
            }
        }

        return $this;
    }

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(Chat $chat): static
    {
        // set the owning side of the relation if necessary
        if ($chat->getCompagny() !== $this) {
            $chat->setCompagny($this);
        }

        $this->chat = $chat;

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): static
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->setCompagny($this);
        }

        return $this;
    }

    public function removeTask(Task $task): static
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getCompagny() === $this) {
                $task->setCompagny(null);
            }
        }

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?\DateTimeImmutable $deleted_at): static
    {
        $this->deleted_at = $deleted_at;

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
            $compagnyModule->setCompagny($this);
        }

        return $this;
    }

    public function removeCompagnyModule(CompagnyModule $compagnyModule): static
    {
        if ($this->compagnyModules->removeElement($compagnyModule)) {
            // set the owning side to null (unless already changed)
            if ($compagnyModule->getCompagny() === $this) {
                $compagnyModule->setCompagny(null);
            }
        }

        return $this;
    }
}
