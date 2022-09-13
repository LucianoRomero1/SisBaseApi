<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GuardBundle\Entity\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="neosys.usuarios")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    public function __construct() {
        parent::__construct();
    }
}

