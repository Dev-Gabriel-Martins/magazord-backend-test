<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "string", length: 11)]
    private string $cpf;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: Contact::class, cascade: ["persist", "remove"], orphanRemoval: true)]
    private Collection $contacts;

    public function __construct(string $name, string $cpf)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->contacts = new ArrayCollection();
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function cpf(): string
    {
        return $this->cpf;
    }

    public function contacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): void
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setUser($this);
        }
    }

    public function removeContact(Contact $contact): void
    {
        if ($this->contacts->removeElement($contact)) {
            $contact->removeUser();
        }
    }
}
