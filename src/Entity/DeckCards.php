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

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?deck $deck_id = null;

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

    public function getDeckId(): ?deck
    {
        return $this->deck_id;
    }

    public function setDeckId(?deck $deck_id): self
    {
        $this->deck_id = $deck_id;

        return $this;
    }
}
