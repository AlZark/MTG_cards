<?php

namespace App\Entity;

use App\Repository\DecksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DecksRepository::class)]
class Decks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'deck', cascade: ['persist', 'remove'])]
    private ?DeckCards $deckCards = null;

    #[ORM\ManyToOne(inversedBy: 'decks')]
    private ?user $owner = null;

    #[ORM\Column]
    private ?int $upvotes = null;

    #[ORM\Column]
    private ?int $downvotes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDeckCards(): ?DeckCards
    {
        return $this->deckCards;
    }

    public function setDeckCards(?DeckCards $deckCards): self
    {
        // unset the owning side of the relation if necessary
        if ($deckCards === null && $this->deckCards !== null) {
            $this->deckCards->setDeck(null);
        }

        // set the owning side of the relation if necessary
        if ($deckCards !== null && $deckCards->getDeck() !== $this) {
            $deckCards->setDeck($this);
        }

        $this->deckCards = $deckCards;

        return $this;
    }

    public function getOwner(): ?user
    {
        return $this->owner;
    }

    public function setOwner(?user $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getUpvotes(): ?int
    {
        return $this->upvotes;
    }

    public function setUpvotes(int $upvotes): self
    {
        $this->upvotes = $upvotes;

        return $this;
    }

    public function getDownvotes(): ?int
    {
        return $this->downvotes;
    }

    public function setDownvotes(int $downvotes): self
    {
        $this->downvotes = $downvotes;

        return $this;
    }
}
