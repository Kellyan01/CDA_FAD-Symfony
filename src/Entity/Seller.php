<?php

namespace App\Entity;

use App\Repository\SellerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Unique;

#[ORM\Entity(repositoryClass: SellerRepository::class)]
class Seller
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name_seller = null;

    #[ORM\Column(length: 50)]
    private ?string $firstname_seller = null;

    #[ORM\Column(length: 50, unique: true)]
    private ?string $email_seller = null;

    /**
     * @var Collection<int, Ticket>
     */
    #[ORM\OneToMany(targetEntity: Ticket::class, mappedBy: 'seller', orphanRemoval: true)]
    private Collection $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSeller(): ?string
    {
        return $this->name_seller;
    }

    public function setNameSeller(string $name_seller): static
    {
        $this->name_seller = $name_seller;

        return $this;
    }

    public function getFirstnameSeller(): ?string
    {
        return $this->firstname_seller;
    }

    public function setFirstnameSeller(string $firstname_seller): static
    {
        $this->firstname_seller = $firstname_seller;

        return $this;
    }

    public function getEmailSeller(): ?string
    {
        return $this->email_seller;
    }

    public function setEmailSeller(string $email_seller): static
    {
        $this->email_seller = $email_seller;

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): static
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets->add($ticket);
            $ticket->setSeller($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): static
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getSeller() === $this) {
                $ticket->setSeller(null);
            }
        }

        return $this;
    }
}
