<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeEvent $type = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatusEvent $status = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\ManyToOne(inversedBy: 'Events')]
    private ?Compagny $compagny = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $created_by = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'events_assigned')]
    private Collection $assigned;


    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Step::class, orphanRemoval: true)]
    private Collection $steps;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Staff $attached = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Document::class)]
    private Collection $documents;

    #[ORM\ManyToMany(targetEntity: Job::class, mappedBy: 'events')]
    private Collection $jobs;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: EventTreated::class, orphanRemoval: true)]
    private Collection $eventTreateds;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $due_date_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $start_date_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $end_date_at = null;

    #[ORM\Column]
    private ?bool $period = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?Priority $priority = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Alert::class, orphanRemoval: true)]
    private Collection $alerts;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Follow::class)]
    private Collection $follows;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deleted_at = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->assigned = new ArrayCollection();
        $this->steps = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->jobs = new ArrayCollection();
        $this->eventTreateds = new ArrayCollection();
        $this->alerts = new ArrayCollection();
        $this->follows = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->title ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

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

    public function getType(): ?TypeEvent
    {
        return $this->type;
    }

    public function setType(?TypeEvent $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?StatusEvent
    {
        return $this->status;
    }

    public function setStatus(?StatusEvent $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setEvent($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getEvent() === $this) {
                $comment->setEvent(null);
            }
        }

        return $this;
    }

    public function getCompagny(): ?Compagny
    {
        return $this->compagny;
    }

    public function setCompagny(?Compagny $compagny): static
    {
        $this->compagny = $compagny;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->created_by;
    }

    public function setCreatedBy(?User $created_by): static
    {
        $this->created_by = $created_by;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAssigned(): Collection
    {
        return $this->assigned;
    }

    public function addAssigned(User $assigned): static
    {
        if (!$this->assigned->contains($assigned)) {
            $this->assigned->add($assigned);
        }

        return $this;
    }

    public function removeAssigned(User $assigned): static
    {
        $this->assigned->removeElement($assigned);

        return $this;
    }

    /**
     * @return Collection<int, Step>
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Step $step): static
    {
        if (!$this->steps->contains($step)) {
            $this->steps->add($step);
            $step->setEvent($this);
        }

        return $this;
    }

    public function removeStep(Step $step): static
    {
        if ($this->steps->removeElement($step)) {
            // set the owning side to null (unless already changed)
            if ($step->getEvent() === $this) {
                $step->setEvent(null);
            }
        }

        return $this;
    }

    public function getAttached(): ?Staff
    {
        return $this->attached;
    }

    public function setAttached(?Staff $attached): static
    {
        $this->attached = $attached;

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
            $document->setEvent($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): static
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getEvent() === $this) {
                $document->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Job>
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): static
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs->add($job);
            $job->addEvent($this);
        }

        return $this;
    }

    public function removeJob(Job $job): static
    {
        if ($this->jobs->removeElement($job)) {
            $job->removeEvent($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, EventTreated>
     */
    public function getEventTreateds(): Collection
    {
        return $this->eventTreateds;
    }

    public function addEventTreated(EventTreated $eventTreated): static
    {
        if (!$this->eventTreateds->contains($eventTreated)) {
            $this->eventTreateds->add($eventTreated);
            $eventTreated->setEvent($this);
        }

        return $this;
    }

    public function removeEventTreated(EventTreated $eventTreated): static
    {
        if ($this->eventTreateds->removeElement($eventTreated)) {
            // set the owning side to null (unless already changed)
            if ($eventTreated->getEvent() === $this) {
                $eventTreated->setEvent(null);
            }
        }

        return $this;
    }

    public function getDueDateAt(): ?\DateTimeImmutable
    {
        return $this->due_date_at;
    }

    public function setDueDateAt(?\DateTimeImmutable $due_date_at): static
    {
        $this->due_date_at = $due_date_at;

        return $this;
    }

    public function getStartDateAt(): ?\DateTimeImmutable
    {
        return $this->start_date_at;
    }

    public function setStartDateAt(?\DateTimeImmutable $start_date_at): static
    {
        $this->start_date_at = $start_date_at;

        return $this;
    }

    public function getEndDateAt(): ?\DateTimeImmutable
    {
        return $this->end_date_at;
    }

    public function setEndDateAt(?\DateTimeImmutable $end_date_at): static
    {
        $this->end_date_at = $end_date_at;

        return $this;
    }

    public function isPeriod(): ?bool
    {
        return $this->period;
    }

    public function setPeriod(bool $period): static
    {
        $this->period = $period;

        return $this;
    }

    public function getPriority(): ?Priority
    {
        return $this->priority;
    }

    public function setPriority(?Priority $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return Collection<int, Alert>
     */
    public function getAlerts(): Collection
    {
        return $this->alerts;
    }

    public function addAlert(Alert $alert): static
    {
        if (!$this->alerts->contains($alert)) {
            $this->alerts->add($alert);
            $alert->setEvent($this);
        }

        return $this;
    }

    public function removeAlert(Alert $alert): static
    {
        if ($this->alerts->removeElement($alert)) {
            // set the owning side to null (unless already changed)
            if ($alert->getEvent() === $this) {
                $alert->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Follow>
     */
    public function getFollows(): Collection
    {
        return $this->follows;
    }

    public function addFollow(Follow $follow): static
    {
        if (!$this->follows->contains($follow)) {
            $this->follows->add($follow);
            $follow->setEvent($this);
        }

        return $this;
    }

    public function removeFollow(Follow $follow): static
    {
        if ($this->follows->removeElement($follow)) {
            // set the owning side to null (unless already changed)
            if ($follow->getEvent() === $this) {
                $follow->setEvent(null);
            }
        }

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

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?\DateTimeImmutable $deleted_at): static
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }
}
