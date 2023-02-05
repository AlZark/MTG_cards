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
    private ?string $card_id = null;

    #[ORM\Column]
    private ?int $deckId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCardId(): ?string
    {
        return $this->card_id;
    }

    public function setCardId(string $card_id): self
    {
        $this->card_id = $card_id;

        return $this;
    }

    public function getDeckId(): ?int
    {
        return $this->deckId;
    }

    public function setDeckId(int $deckId): self
    {
        $this->deckId = $deckId;

        return $this;
    }
}
