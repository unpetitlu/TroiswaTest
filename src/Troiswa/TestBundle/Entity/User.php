<?php
// src/Acme/UserBundle/Entity/User.php

namespace Troiswa\TestBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="bidule", type="string", length=255, nullable=true)
     */
    protected $bidule;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set bidule
     *
     * @param string $bidule
     * @return User
     */
    public function setBidule($bidule)
    {
        $this->bidule = $bidule;

        return $this;
    }

    /**
     * Get bidule
     *
     * @return string 
     */
    public function getBidule()
    {
        return $this->bidule;
    }
}
