<?php

namespace Troiswa\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Movie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Troiswa\TestBundle\Entity\MovieRepository")
 */
class Movie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
    * @ORM\ManyToMany(targetEntity="Troiswa\TestBundle\Entity\Actor", mappedBy="movies")
    */
    private $actors;

    /**
    * @ORM\ManyToOne(targetEntity="Troiswa\TestBundle\Entity\Category", inversedBy="movies")
    * @Assert\Valid()
    */
    private $category;

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
     * Set titre
     *
     * @param string $titre
     * @return Movie
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add actors
     *
     * @param \Troiswa\TestBundle\Entity\Actor $actors
     * @return Movie
     */
    public function addActor(\Troiswa\TestBundle\Entity\Actor $actors)
    {
        echo "hello";
        foreach ($this->actors->getSnapShot() as $actor)
        {
            echo 'supprimer : '.$actor->getId(); 
            $actor->removeMovie($this);
        }

        $this->actors[] = $actors;
        
        foreach ($this->actors as $actor)
        {
            echo 'ajout : '.$actor->getId();
            $actor->addMovie($this);
        }
    }

    /**
     * Remove actors
     *
     * @param \Troiswa\TestBundle\Entity\Actor $actors
     */
    public function removeActor(\Troiswa\TestBundle\Entity\Actor $actors)
    {
        $this->actors->removeElement($actors);
    }

    /**
     * Get actors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * Set category
     *
     * @param \Troiswa\TestBundle\Entity\Category $category
     * @return Movie
     */
    public function setCategory(\Troiswa\TestBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Troiswa\TestBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function __toString()
    {
        return $this->titre;
    }
}
