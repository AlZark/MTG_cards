<?php

namespace App\Entity;

use App\Repository\DeckCardsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeckCardsRepository::class)]
class DeckCards
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $card_id = null;

    #[ORM\OneToOne(inversedBy: 'deckCards', cascade: ['persist', 'remove'])]
    private ?Decks $deck = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCardId(): ?int
    {
        return $this->card_id;
    }

    public function setCardId(int $card_id): self
    {
        $this->card_id = $card_id;

        return $this;
    }

    public function getDeck(): ?Decks
    {
        return $this->deck;
    }

    public function setDeck(?Decks $deck): self
    {
        $this->deck = $deck;

        return $this;
    }
}
