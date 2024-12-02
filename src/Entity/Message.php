<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chat $chat = null;

    #[ORM\ManyToMany(targetEntity: MessageSend::class, mappedBy: 'messages')]
    private Collection $messageSends;

    #[ORM\ManyToMany(targetEntity: MessageReceive::class, mappedBy: 'messages')]
    private Collection $messageReceives;

    public function __construct()
    {
        $this->messageSends = new ArrayCollection();
        $this->messageReceives = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(?Chat $chat): static
    {
        $this->chat = $chat;

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
            $messageSend->addMessage($this);
        }

        return $this;
    }

    public function removeMessageSend(MessageSend $messageSend): static
    {
        if ($this->messageSends->removeElement($messageSend)) {
            $messageSend->removeMessage($this);
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
            $messageReceive->addMessage($this);
        }

        return $this;
    }

    public function removeMessageReceive(MessageReceive $messageReceive): static
    {
        if ($this->messageReceives->removeElement($messageReceive)) {
            $messageReceive->removeMessage($this);
        }

        return $this;
    }
}
