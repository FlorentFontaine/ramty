<?php

namespace App\Entity;

use App\Repository\MessageReceiveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageReceiveRepository::class)]
class MessageReceive
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'messageReceives')]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: Message::class, inversedBy: 'messageReceives')]
    private Collection $messages;

    #[ORM\Column]
    private ?bool $view = null;

    #[ORM\OneToOne(inversedBy: 'messageReceive', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?MessageSend $message_send = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        $this->messages->removeElement($message);

        return $this;
    }

    public function isView(): ?bool
    {
        return $this->view;
    }

    public function setView(bool $view): static
    {
        $this->view = $view;

        return $this;
    }

    public function getMessageSend(): ?MessageSend
    {
        return $this->message_send;
    }

    public function setMessageSend(MessageSend $message_send): static
    {
        $this->message_send = $message_send;

        return $this;
    }
}
