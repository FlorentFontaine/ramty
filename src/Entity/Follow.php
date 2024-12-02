<?php

namespace App\Entity;

use App\Repository\FollowRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FollowRepository::class)]
class Follow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'follows')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'follows')]
    private ?Event $event = null;

    #[ORM\ManyToOne(inversedBy: 'follows')]
    private ?Task $task = null;

    #[ORM\ManyToOne(inversedBy: 'follows')]
    private ?Staff $staff = null;

    #[ORM\ManyToOne(inversedBy: 'follows')]
    private ?Team $team = null;

    #[ORM\ManyToOne(inversedBy: 'follows')]
    private ?Candidacy $candidacy = null;

    #[ORM\ManyToOne(inversedBy: 'followsUser')]
    private ?User $user_follow = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): static
    {
        $this->event = $event;

        return $this;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function setTask(?Task $task): static
    {
        $this->task = $task;

        return $this;
    }

    public function getStaff(): ?Staff
    {
        return $this->staff;
    }

    public function setStaff(?Staff $staff): static
    {
        $this->staff = $staff;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): static
    {
        $this->team = $team;

        return $this;
    }

    public function getCandidacy(): ?Candidacy
    {
        return $this->candidacy;
    }

    public function setCandidacy(?Candidacy $candidacy): static
    {
        $this->candidacy = $candidacy;

        return $this;
    }

    public function getUserFollow(): ?User
    {
        return $this->user_follow;
    }

    public function setUserFollow(?User $user_follow): static
    {
        $this->user_follow = $user_follow;

        return $this;
    }
}
