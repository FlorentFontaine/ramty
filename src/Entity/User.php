<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Compagny $compagny = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Address::class)]
    private Collection $addresses;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: Alert::class, orphanRemoval: true)]
    private Collection $alerts;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: Candidacy::class, orphanRemoval: true)]
    private Collection $candidacies;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: Document::class, orphanRemoval: true)]
    private Collection $documents;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: Event::class, orphanRemoval: true)]
    private Collection $events;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: Research::class, orphanRemoval: true)]
    private Collection $research;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: Staff::class, orphanRemoval: true)]
    private Collection $staff;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: Step::class, orphanRemoval: true)]
    private Collection $steps;

    #[ORM\ManyToMany(targetEntity: Team::class, mappedBy: 'users')]
    private Collection $teams;

    #[ORM\ManyToMany(targetEntity: Event::class, mappedBy: 'assigned')]
    private Collection $events_assigned;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: EventTreated::class, orphanRemoval: true)]
    private Collection $eventTreateds;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?PreferenceUser $preferenceUser = null;

    #[ORM\ManyToMany(targetEntity: Channel::class, mappedBy: 'members')]
    private Collection $channels;

    #[ORM\ManyToMany(targetEntity: MessageSend::class, mappedBy: 'user')]
    private Collection $messageSends;

    #[ORM\ManyToMany(targetEntity: MessageReceive::class, mappedBy: 'users')]
    private Collection $messageReceives;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Favorite::class, orphanRemoval: true)]
    private Collection $favorites;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: Task::class, orphanRemoval: true)]
    private Collection $tasks;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Follow::class, orphanRemoval: true)]
    private Collection $follows;

    #[ORM\OneToMany(mappedBy: 'user_follow', targetEntity: Follow::class)]
    private Collection $followsUser;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deleted_at = null;

    #[ORM\OneToOne(inversedBy: 'related_user', cascade: ['persist', 'remove'])]
    private ?Staff $related_staff = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Right::class, orphanRemoval: true)]
    private Collection $rights;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Notification::class, orphanRemoval: true)]
    private Collection $notifications;

    #[ORM\OneToMany(mappedBy: 'responsible', targetEntity: Team::class)]
    private Collection $responsible_teams;

    #[ORM\OneToOne(inversedBy: 'cover_user', cascade: ['persist', 'remove'])]
    private ?Image $image_cover = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Job $job = null;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->alerts = new ArrayCollection();
        $this->candidacies = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->research = new ArrayCollection();
        $this->staff = new ArrayCollection();
        $this->steps = new ArrayCollection();
        $this->teams = new ArrayCollection();
        $this->events_assigned = new ArrayCollection();
        $this->eventTreateds = new ArrayCollection();
        $this->channels = new ArrayCollection();
        $this->messageSends = new ArrayCollection();
        $this->messageReceives = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->tasks = new ArrayCollection();
        $this->follows = new ArrayCollection();
        $this->followsUser = new ArrayCollection();
        $this->rights = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->responsible_teams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getEmail();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

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

    public function getPrincipalAddress(): ?String
    {
        return $this->addresses->first() ? $this->addresses->first()->getFullAddress() ?? null : "Aucune adresse";
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
            $address->setUser($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): static
    {
        if ($this->addresses->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getUser() === $this) {
                $address->setUser(null);
            }
        }

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
            $alert->setCreatedBy($this);
        }

        return $this;
    }

    public function removeAlert(Alert $alert): static
    {
        if ($this->alerts->removeElement($alert)) {
            // set the owning side to null (unless already changed)
            if ($alert->getCreatedBy() === $this) {
                $alert->setCreatedBy(null);
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
            $candidacy->setCreatedBy($this);
        }

        return $this;
    }

    public function removeCandidacy(Candidacy $candidacy): static
    {
        if ($this->candidacies->removeElement($candidacy)) {
            // set the owning side to null (unless already changed)
            if ($candidacy->getCreatedBy() === $this) {
                $candidacy->setCreatedBy(null);
            }
        }

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
            $comment->setCreatedBy($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCreatedBy() === $this) {
                $comment->setCreatedBy(null);
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
            $document->setCreatedBy($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): static
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getCreatedBy() === $this) {
                $document->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setCreatedBy($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getCreatedBy() === $this) {
                $event->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Research>
     */
    public function getResearch(): Collection
    {
        return $this->research;
    }

    public function addResearch(Research $research): static
    {
        if (!$this->research->contains($research)) {
            $this->research->add($research);
            $research->setCreatedBy($this);
        }

        return $this;
    }

    public function removeResearch(Research $research): static
    {
        if ($this->research->removeElement($research)) {
            // set the owning side to null (unless already changed)
            if ($research->getCreatedBy() === $this) {
                $research->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Staff>
     */
    public function getStaff(): Collection
    {
        return $this->staff;
    }

    public function addStaff(Staff $staff): static
    {
        if (!$this->staff->contains($staff)) {
            $this->staff->add($staff);
            $staff->setCreatedBy($this);
        }

        return $this;
    }

    public function removeStaff(Staff $staff): static
    {
        if ($this->staff->removeElement($staff)) {
            // set the owning side to null (unless already changed)
            if ($staff->getCreatedBy() === $this) {
                $staff->setCreatedBy(null);
            }
        }

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
            $step->setCreatedBy($this);
        }

        return $this;
    }

    public function removeStep(Step $step): static
    {
        if ($this->steps->removeElement($step)) {
            // set the owning side to null (unless already changed)
            if ($step->getCreatedBy() === $this) {
                $step->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): static
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->addUser($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): static
    {
        if ($this->teams->removeElement($team)) {
            $team->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEventsAssigned(): Collection
    {
        return $this->events_assigned;
    }

    public function addEventsAssigned(Event $eventsAssigned): static
    {
        if (!$this->events_assigned->contains($eventsAssigned)) {
            $this->events_assigned->add($eventsAssigned);
            $eventsAssigned->addAssigned($this);
        }

        return $this;
    }

    public function removeEventsAssigned(Event $eventsAssigned): static
    {
        if ($this->events_assigned->removeElement($eventsAssigned)) {
            $eventsAssigned->removeAssigned($this);
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
            $eventTreated->setUser($this);
        }

        return $this;
    }

    public function removeEventTreated(EventTreated $eventTreated): static
    {
        if ($this->eventTreateds->removeElement($eventTreated)) {
            // set the owning side to null (unless already changed)
            if ($eventTreated->getUser() === $this) {
                $eventTreated->setUser(null);
            }
        }

        return $this;
    }

    public function getPreferenceUser(): ?PreferenceUser
    {
        return $this->preferenceUser;
    }

    public function setPreferenceUser(PreferenceUser $preferenceUser): static
    {
        // set the owning side of the relation if necessary
        if ($preferenceUser->getUser() !== $this) {
            $preferenceUser->setUser($this);
        }

        $this->preferenceUser = $preferenceUser;

        return $this;
    }

    /**
     * @return Collection<int, Channel>
     */
    public function getChannels(): Collection
    {
        return $this->channels;
    }

    public function addChannel(Channel $channel): static
    {
        if (!$this->channels->contains($channel)) {
            $this->channels->add($channel);
            $channel->addMember($this);
        }

        return $this;
    }

    public function removeChannel(Channel $channel): static
    {
        if ($this->channels->removeElement($channel)) {
            $channel->removeMember($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, MessageSend>
     */
    public function getMessageSends(): Collection
    {
        return $this->messageSends;
    }

    public function addMessageSend(MessageSend $messageSend): static
    {
        if (!$this->messageSends->contains($messageSend)) {
            $this->messageSends->add($messageSend);
            $messageSend->addUser($this);
        }

        return $this;
    }

    public function removeMessageSend(MessageSend $messageSend): static
    {
        if ($this->messageSends->removeElement($messageSend)) {
            $messageSend->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, MessageReceive>
     */
    public function getMessageReceives(): Collection
    {
        return $this->messageReceives;
    }

    public function addMessageReceive(MessageReceive $messageReceive): static
    {
        if (!$this->messageReceives->contains($messageReceive)) {
            $this->messageReceives->add($messageReceive);
            $messageReceive->addUser($this);
        }

        return $this;
    }

    public function removeMessageReceive(MessageReceive $messageReceive): static
    {
        if ($this->messageReceives->removeElement($messageReceive)) {
            $messageReceive->removeUser($this);
        }

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, Favorite>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorite $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->setUser($this);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getUser() === $this) {
                $favorite->setUser(null);
            }
        }

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
            $task->setCreatedBy($this);
        }

        return $this;
    }

    public function removeTask(Task $task): static
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getCreatedBy() === $this) {
                $task->setCreatedBy(null);
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
            $follow->setUser($this);
        }

        return $this;
    }

    public function removeFollow(Follow $follow): static
    {
        if ($this->follows->removeElement($follow)) {
            // set the owning side to null (unless already changed)
            if ($follow->getUser() === $this) {
                $follow->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Follow>
     */
    public function getFollowsUser(): Collection
    {
        return $this->followsUser;
    }

    public function addFollowsUser(Follow $followsUser): static
    {
        if (!$this->followsUser->contains($followsUser)) {
            $this->followsUser->add($followsUser);
            $followsUser->setUserFollow($this);
        }

        return $this;
    }

    public function removeFollowsUser(Follow $followsUser): static
    {
        if ($this->followsUser->removeElement($followsUser)) {
            // set the owning side to null (unless already changed)
            if ($followsUser->getUserFollow() === $this) {
                $followsUser->setUserFollow(null);
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

    public function getRelatedStaff(): ?Staff
    {
        return $this->related_staff;
    }

    public function setRelatedStaff(?Staff $related_staff): static
    {
        $this->related_staff = $related_staff;

        return $this;
    }

    /**
     * @return Collection<int, Right>
     */
    public function getRights(): Collection
    {
        return $this->rights;
    }

    public function addRight(Right $right): static
    {
        if (!$this->rights->contains($right)) {
            $this->rights->add($right);
            $right->setUser($this);
        }

        return $this;
    }

    public function removeRight(Right $right): static
    {
        if ($this->rights->removeElement($right)) {
            // set the owning side to null (unless already changed)
            if ($right->getUser() === $this) {
                $right->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): static
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications->add($notification);
            $notification->setUser($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): static
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getUser() === $this) {
                $notification->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getResponsibleTeams(): Collection
    {
        return $this->responsible_teams;
    }

    public function addResponsibleTeam(Team $responsibleTeam): static
    {
        if (!$this->responsible_teams->contains($responsibleTeam)) {
            $this->responsible_teams->add($responsibleTeam);
            $responsibleTeam->setResponsible($this);
        }

        return $this;
    }

    public function removeResponsibleTeam(Team $responsibleTeam): static
    {
        if ($this->responsible_teams->removeElement($responsibleTeam)) {
            // set the owning side to null (unless already changed)
            if ($responsibleTeam->getResponsible() === $this) {
                $responsibleTeam->setResponsible(null);
            }
        }

        return $this;
    }

    public function getImageCover(): ?Image
    {
        return $this->image_cover;
    }

    public function setImageCover(?Image $image_cover): static
    {
        $this->image_cover = $image_cover;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): static
    {
        $this->job = $job;

        return $this;
    }
}
