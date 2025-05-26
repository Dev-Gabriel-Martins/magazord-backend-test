<?php

namespace app\models;

use core\classes\Model;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends Model
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\Column(type="string", length=255) */
    private $name;

    /** @ORM\Column(type="string", length=11) */
    private $cpf;

    /**
     * @ORM\OneToMany(targetEntity="Contact", mappedBy="user")
     */
    private $contacts;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
    }
}
