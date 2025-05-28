<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "contacts")]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "boolean")]
    private bool $type;

    #[ORM\Column(type: "string", length: 255)]
    private string $description;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "contacts")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?User $user = null;

    public function __construct(bool $type, string $description)
    {
        $this->type = $type;
        $this->description = $description;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function type(): bool
    {
        return $this->type;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function user(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}