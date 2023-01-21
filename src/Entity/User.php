<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $fullname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Decks::class)]
    private Collection $decks;

    public function __construct()
    {
        $this->decks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Decks>
     */
    public function getDecks(): Collection
    {
        return $this->decks;
    }

    public function addDeck(Decks $deck): self
    {
        if (!$this->decks->contains($deck)) {
            $this->decks->add($deck);
            $deck->setOwner($this);
        }

        return $this;
    }

    public function removeDeck(Decks $deck): self
    {
        if ($this->decks->removeElement($deck)) {
            // set the owning side to null (unless already changed)
            if ($deck->getOwner() === $this) {
                $deck->setOwner(null);
            }
        }

        return $this;
    }
}
