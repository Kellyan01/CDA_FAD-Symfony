<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Unique;

//Validator : permet de renforcer la validation d'un formulaire lorsqu'on utilise isValid() dans le Controller
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, unique: true)]
    //Exemple d'Assert comme contrainte de Validation
    #[Assert\Length(min : 1, max : 10, maxMessage : "Limite de 10 caractères", minMessage : "au moins 1 caractère" )]
    #[Assert\NotBlank(message : 'Le Nom ne doit pas être Vide')]
    private ?string $name_product = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description_product = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price_product = null;

    /**
     * @var Collection<int, Ticket>
     */
    #[ORM\ManyToMany(targetEntity: Ticket::class, mappedBy: 'products')]
    private Collection $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameProduct(): ?string
    {
        return $this->name_product;
    }

    public function setNameProduct(string $name_product): static
    {
        $this->name_product = $name_product;

        return $this;
    }

    public function getDescriptionProduct(): ?string
    {
        return $this->description_product;
    }

    public function setDescriptionProduct(?string $description_product): static
    {
        $this->description_product = $description_product;

        return $this;
    }

    public function getPriceProduct(): ?string
    {
        return $this->price_product;
    }

    public function setPriceProduct(string $price_product): static
    {
        $this->price_product = $price_product;

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
            $ticket->addProduct($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): static
    {
        if ($this->tickets->removeElement($ticket)) {
            $ticket->removeProduct($this);
        }

        return $this;
    }
}
