<?php

namespace app\models;

use core\classes\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contacts")
 */
class Contact extends Model
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\Column(type="boolean") */
    private $type;

    /** @ORM\Column(type="string", length=255) */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="contacts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $user;

    
}