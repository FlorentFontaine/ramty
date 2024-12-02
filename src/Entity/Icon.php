<?php

namespace App\Entity;

use App\Repository\IconRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IconRepository::class)]
class Icon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $class = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: StatusAlert::class)]
    private Collection $statusAlerts;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: StatusCandidacy::class)]
    private Collection $statusCandidacies;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: StatusEvent::class)]
    private Collection $statusEvents;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: StatusJob::class)]
    private Collection $statusJobs;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: StatusStep::class)]
    private Collection $statusSteps;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: StatusTask::class)]
    private Collection $statusTasks;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeAlert::class)]
    private Collection $typeAlerts;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeCandidacy::class)]
    private Collection $typeCandidacies;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeCompetence::class)]
    private Collection $typeCompetences;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeConfigResearch::class)]
    private Collection $typeConfigResearch;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeCriteria::class)]
    private Collection $typeCriterias;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeDocument::class)]
    private Collection $typeDocuments;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeEvent::class)]
    private Collection $typeEvents;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeJob::class)]
    private Collection $typeJobs;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeLevel::class)]
    private Collection $typeLevels;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeResearch::class)]
    private Collection $typeResearch;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeStaff::class)]
    private Collection $typeStaff;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeStep::class)]
    private Collection $typeSteps;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeTask::class)]
    private Collection $typeTasks;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: Priority::class)]
    private Collection $priorities;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeRight::class)]
    private Collection $typeRights;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: TypeNotification::class)]
    private Collection $typeNotifications;

    public function __construct()
    {
        $this->statusAlerts = new ArrayCollection();
        $this->statusCandidacies = new ArrayCollection();
        $this->statusEvents = new ArrayCollection();
        $this->statusJobs = new ArrayCollection();
        $this->statusSteps = new ArrayCollection();
        $this->statusTasks = new ArrayCollection();
        $this->typeAlerts = new ArrayCollection();
        $this->typeCandidacies = new ArrayCollection();
        $this->typeCompetences = new ArrayCollection();
        $this->typeConfigResearch = new ArrayCollection();
        $this->typeCriterias = new ArrayCollection();
        $this->typeDocuments = new ArrayCollection();
        $this->typeEvents = new ArrayCollection();
        $this->typeJobs = new ArrayCollection();
        $this->typeLevels = new ArrayCollection();
        $this->typeResearch = new ArrayCollection();
        $this->typeStaff = new ArrayCollection();
        $this->typeSteps = new ArrayCollection();
        $this->typeTasks = new ArrayCollection();
        $this->priorities = new ArrayCollection();
        $this->typeRights = new ArrayCollection();
        $this->typeNotifications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): static
    {
        $this->class = $class;

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
     * @return Collection<int, StatusAlert>
     */
    public function getStatusAlerts(): Collection
    {
        return $this->statusAlerts;
    }

    public function addStatusAlert(StatusAlert $statusAlert): static
    {
        if (!$this->statusAlerts->contains($statusAlert)) {
            $this->statusAlerts->add($statusAlert);
            $statusAlert->setIcon($this);
        }

        return $this;
    }

    public function removeStatusAlert(StatusAlert $statusAlert): static
    {
        if ($this->statusAlerts->removeElement($statusAlert)) {
            // set the owning side to null (unless already changed)
            if ($statusAlert->getIcon() === $this) {
                $statusAlert->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StatusCandidacy>
     */
    public function getStatusCandidacies(): Collection
    {
        return $this->statusCandidacies;
    }

    public function addStatusCandidacy(StatusCandidacy $statusCandidacy): static
    {
        if (!$this->statusCandidacies->contains($statusCandidacy)) {
            $this->statusCandidacies->add($statusCandidacy);
            $statusCandidacy->setIcon($this);
        }

        return $this;
    }

    public function removeStatusCandidacy(StatusCandidacy $statusCandidacy): static
    {
        if ($this->statusCandidacies->removeElement($statusCandidacy)) {
            // set the owning side to null (unless already changed)
            if ($statusCandidacy->getIcon() === $this) {
                $statusCandidacy->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StatusEvent>
     */
    public function getStatusEvents(): Collection
    {
        return $this->statusEvents;
    }

    public function addStatusEvent(StatusEvent $statusEvent): static
    {
        if (!$this->statusEvents->contains($statusEvent)) {
            $this->statusEvents->add($statusEvent);
            $statusEvent->setIcon($this);
        }

        return $this;
    }

    public function removeStatusEvent(StatusEvent $statusEvent): static
    {
        if ($this->statusEvents->removeElement($statusEvent)) {
            // set the owning side to null (unless already changed)
            if ($statusEvent->getIcon() === $this) {
                $statusEvent->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StatusJob>
     */
    public function getStatusJobs(): Collection
    {
        return $this->statusJobs;
    }

    public function addStatusJob(StatusJob $statusJob): static
    {
        if (!$this->statusJobs->contains($statusJob)) {
            $this->statusJobs->add($statusJob);
            $statusJob->setIcon($this);
        }

        return $this;
    }

    public function removeStatusJob(StatusJob $statusJob): static
    {
        if ($this->statusJobs->removeElement($statusJob)) {
            // set the owning side to null (unless already changed)
            if ($statusJob->getIcon() === $this) {
                $statusJob->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StatusStep>
     */
    public function getStatusSteps(): Collection
    {
        return $this->statusSteps;
    }

    public function addStatusStep(StatusStep $statusStep): static
    {
        if (!$this->statusSteps->contains($statusStep)) {
            $this->statusSteps->add($statusStep);
            $statusStep->setIcon($this);
        }

        return $this;
    }

    public function removeStatusStep(StatusStep $statusStep): static
    {
        if ($this->statusSteps->removeElement($statusStep)) {
            // set the owning side to null (unless already changed)
            if ($statusStep->getIcon() === $this) {
                $statusStep->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StatusTask>
     */
    public function getStatusTasks(): Collection
    {
        return $this->statusTasks;
    }

    public function addStatusTask(StatusTask $statusTask): static
    {
        if (!$this->statusTasks->contains($statusTask)) {
            $this->statusTasks->add($statusTask);
            $statusTask->setIcon($this);
        }

        return $this;
    }

    public function removeStatusTask(StatusTask $statusTask): static
    {
        if ($this->statusTasks->removeElement($statusTask)) {
            // set the owning side to null (unless already changed)
            if ($statusTask->getIcon() === $this) {
                $statusTask->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeAlert>
     */
    public function getTypeAlerts(): Collection
    {
        return $this->typeAlerts;
    }

    public function addTypeAlert(TypeAlert $typeAlert): static
    {
        if (!$this->typeAlerts->contains($typeAlert)) {
            $this->typeAlerts->add($typeAlert);
            $typeAlert->setIcon($this);
        }

        return $this;
    }

    public function removeTypeAlert(TypeAlert $typeAlert): static
    {
        if ($this->typeAlerts->removeElement($typeAlert)) {
            // set the owning side to null (unless already changed)
            if ($typeAlert->getIcon() === $this) {
                $typeAlert->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeCandidacy>
     */
    public function getTypeCandidacies(): Collection
    {
        return $this->typeCandidacies;
    }

    public function addTypeCandidacy(TypeCandidacy $typeCandidacy): static
    {
        if (!$this->typeCandidacies->contains($typeCandidacy)) {
            $this->typeCandidacies->add($typeCandidacy);
            $typeCandidacy->setIcon($this);
        }

        return $this;
    }

    public function removeTypeCandidacy(TypeCandidacy $typeCandidacy): static
    {
        if ($this->typeCandidacies->removeElement($typeCandidacy)) {
            // set the owning side to null (unless already changed)
            if ($typeCandidacy->getIcon() === $this) {
                $typeCandidacy->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeCompetence>
     */
    public function getTypeCompetences(): Collection
    {
        return $this->typeCompetences;
    }

    public function addTypeCompetence(TypeCompetence $typeCompetence): static
    {
        if (!$this->typeCompetences->contains($typeCompetence)) {
            $this->typeCompetences->add($typeCompetence);
            $typeCompetence->setIcon($this);
        }

        return $this;
    }

    public function removeTypeCompetence(TypeCompetence $typeCompetence): static
    {
        if ($this->typeCompetences->removeElement($typeCompetence)) {
            // set the owning side to null (unless already changed)
            if ($typeCompetence->getIcon() === $this) {
                $typeCompetence->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeConfigResearch>
     */
    public function getTypeConfigResearch(): Collection
    {
        return $this->typeConfigResearch;
    }

    public function addTypeConfigResearch(TypeConfigResearch $typeConfigResearch): static
    {
        if (!$this->typeConfigResearch->contains($typeConfigResearch)) {
            $this->typeConfigResearch->add($typeConfigResearch);
            $typeConfigResearch->setIcon($this);
        }

        return $this;
    }

    public function removeTypeConfigResearch(TypeConfigResearch $typeConfigResearch): static
    {
        if ($this->typeConfigResearch->removeElement($typeConfigResearch)) {
            // set the owning side to null (unless already changed)
            if ($typeConfigResearch->getIcon() === $this) {
                $typeConfigResearch->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeCriteria>
     */
    public function getTypeCriterias(): Collection
    {
        return $this->typeCriterias;
    }

    public function addTypeCriteria(TypeCriteria $typeCriteria): static
    {
        if (!$this->typeCriterias->contains($typeCriteria)) {
            $this->typeCriterias->add($typeCriteria);
            $typeCriteria->setIcon($this);
        }

        return $this;
    }

    public function removeTypeCriteria(TypeCriteria $typeCriteria): static
    {
        if ($this->typeCriterias->removeElement($typeCriteria)) {
            // set the owning side to null (unless already changed)
            if ($typeCriteria->getIcon() === $this) {
                $typeCriteria->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeDocument>
     */
    public function getTypeDocuments(): Collection
    {
        return $this->typeDocuments;
    }

    public function addTypeDocument(TypeDocument $typeDocument): static
    {
        if (!$this->typeDocuments->contains($typeDocument)) {
            $this->typeDocuments->add($typeDocument);
            $typeDocument->setIcon($this);
        }

        return $this;
    }

    public function removeTypeDocument(TypeDocument $typeDocument): static
    {
        if ($this->typeDocuments->removeElement($typeDocument)) {
            // set the owning side to null (unless already changed)
            if ($typeDocument->getIcon() === $this) {
                $typeDocument->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeEvent>
     */
    public function getTypeEvents(): Collection
    {
        return $this->typeEvents;
    }

    public function addTypeEvent(TypeEvent $typeEvent): static
    {
        if (!$this->typeEvents->contains($typeEvent)) {
            $this->typeEvents->add($typeEvent);
            $typeEvent->setIcon($this);
        }

        return $this;
    }

    public function removeTypeEvent(TypeEvent $typeEvent): static
    {
        if ($this->typeEvents->removeElement($typeEvent)) {
            // set the owning side to null (unless already changed)
            if ($typeEvent->getIcon() === $this) {
                $typeEvent->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeJob>
     */
    public function getTypeJobs(): Collection
    {
        return $this->typeJobs;
    }

    public function addTypeJob(TypeJob $typeJob): static
    {
        if (!$this->typeJobs->contains($typeJob)) {
            $this->typeJobs->add($typeJob);
            $typeJob->setIcon($this);
        }

        return $this;
    }

    public function removeTypeJob(TypeJob $typeJob): static
    {
        if ($this->typeJobs->removeElement($typeJob)) {
            // set the owning side to null (unless already changed)
            if ($typeJob->getIcon() === $this) {
                $typeJob->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeLevel>
     */
    public function getTypeLevels(): Collection
    {
        return $this->typeLevels;
    }

    public function addTypeLevel(TypeLevel $typeLevel): static
    {
        if (!$this->typeLevels->contains($typeLevel)) {
            $this->typeLevels->add($typeLevel);
            $typeLevel->setIcon($this);
        }

        return $this;
    }

    public function removeTypeLevel(TypeLevel $typeLevel): static
    {
        if ($this->typeLevels->removeElement($typeLevel)) {
            // set the owning side to null (unless already changed)
            if ($typeLevel->getIcon() === $this) {
                $typeLevel->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeResearch>
     */
    public function getTypeResearch(): Collection
    {
        return $this->typeResearch;
    }

    public function addTypeResearch(TypeResearch $typeResearch): static
    {
        if (!$this->typeResearch->contains($typeResearch)) {
            $this->typeResearch->add($typeResearch);
            $typeResearch->setIcon($this);
        }

        return $this;
    }

    public function removeTypeResearch(TypeResearch $typeResearch): static
    {
        if ($this->typeResearch->removeElement($typeResearch)) {
            // set the owning side to null (unless already changed)
            if ($typeResearch->getIcon() === $this) {
                $typeResearch->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeStaff>
     */
    public function getTypeStaff(): Collection
    {
        return $this->typeStaff;
    }

    public function addTypeStaff(TypeStaff $typeStaff): static
    {
        if (!$this->typeStaff->contains($typeStaff)) {
            $this->typeStaff->add($typeStaff);
            $typeStaff->setIcon($this);
        }

        return $this;
    }

    public function removeTypeStaff(TypeStaff $typeStaff): static
    {
        if ($this->typeStaff->removeElement($typeStaff)) {
            // set the owning side to null (unless already changed)
            if ($typeStaff->getIcon() === $this) {
                $typeStaff->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeStep>
     */
    public function getTypeSteps(): Collection
    {
        return $this->typeSteps;
    }

    public function addTypeStep(TypeStep $typeStep): static
    {
        if (!$this->typeSteps->contains($typeStep)) {
            $this->typeSteps->add($typeStep);
            $typeStep->setIcon($this);
        }

        return $this;
    }

    public function removeTypeStep(TypeStep $typeStep): static
    {
        if ($this->typeSteps->removeElement($typeStep)) {
            // set the owning side to null (unless already changed)
            if ($typeStep->getIcon() === $this) {
                $typeStep->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeTask>
     */
    public function getTypeTasks(): Collection
    {
        return $this->typeTasks;
    }

    public function addTypeTask(TypeTask $typeTask): static
    {
        if (!$this->typeTasks->contains($typeTask)) {
            $this->typeTasks->add($typeTask);
            $typeTask->setIcon($this);
        }

        return $this;
    }

    public function removeTypeTask(TypeTask $typeTask): static
    {
        if ($this->typeTasks->removeElement($typeTask)) {
            // set the owning side to null (unless already changed)
            if ($typeTask->getIcon() === $this) {
                $typeTask->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Priority>
     */
    public function getPriorities(): Collection
    {
        return $this->priorities;
    }

    public function addPriority(Priority $priority): static
    {
        if (!$this->priorities->contains($priority)) {
            $this->priorities->add($priority);
            $priority->setIcon($this);
        }

        return $this;
    }

    public function removePriority(Priority $priority): static
    {
        if ($this->priorities->removeElement($priority)) {
            // set the owning side to null (unless already changed)
            if ($priority->getIcon() === $this) {
                $priority->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeRight>
     */
    public function getTypeRights(): Collection
    {
        return $this->typeRights;
    }

    public function addTypeRight(TypeRight $typeRight): static
    {
        if (!$this->typeRights->contains($typeRight)) {
            $this->typeRights->add($typeRight);
            $typeRight->setIcon($this);
        }

        return $this;
    }

    public function removeTypeRight(TypeRight $typeRight): static
    {
        if ($this->typeRights->removeElement($typeRight)) {
            // set the owning side to null (unless already changed)
            if ($typeRight->getIcon() === $this) {
                $typeRight->setIcon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeNotification>
     */
    public function getTypeNotifications(): Collection
    {
        return $this->typeNotifications;
    }

    public function addTypeNotification(TypeNotification $typeNotification): static
    {
        if (!$this->typeNotifications->contains($typeNotification)) {
            $this->typeNotifications->add($typeNotification);
            $typeNotification->setIcon($this);
        }

        return $this;
    }

    public function removeTypeNotification(TypeNotification $typeNotification): static
    {
        if ($this->typeNotifications->removeElement($typeNotification)) {
            // set the owning side to null (unless already changed)
            if ($typeNotification->getIcon() === $this) {
                $typeNotification->setIcon(null);
            }
        }

        return $this;
    }
}
