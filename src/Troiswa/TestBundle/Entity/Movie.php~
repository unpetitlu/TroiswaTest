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
    * @ORM\OneToMany(targetEntity="Troiswa\TestBundle\Entity\MovieTag", mappedBy="movie")
    */
    private $tags;

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
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add actors
     *
     * @param \Troiswa\TestBundle\Entity\Actor $actors
     * @return Movie
     */
    public function addActor(\Troiswa\TestBundle\Entity\Actor $actors)
    {
        $this->actors[] = $actors;
        $actors->addMovie($this);
    }

    /**
     * Remove actors
     *
     * @param \Troiswa\TestBundle\Entity\Actor $actors
     */
    public function removeActor(\Troiswa\TestBundle\Entity\Actor $actors)
    {
        $this->actors->removeElement($actors);
        $actors->removeMovie($this);
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

    /**
     * Add tags
     *
     * @param \Troiswa\TestBundle\Entity\MovieTag $tags
     * @return Movie
     */
    public function addTag(\Troiswa\TestBundle\Entity\MovieTag $tags)
    {
        $this->tags[] = $tags;
        $tags->setMovie($this);

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Troiswa\TestBundle\Entity\MovieTag $tags
     */
    public function removeTag(\Troiswa\TestBundle\Entity\MovieTag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    public function setTags()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
