<?php

namespace Troiswa\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Troiswa\TestBundle\Entity\ActorRepository")
 */
class Actor
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
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
    * @ORM\OneToOne(targetEntity="Troiswa\TestBundle\Entity\Image", cascade={"persist", "remove"})
    */
    private $image;

    /**
    * @ORM\ManyToMany(targetEntity="Troiswa\TestBundle\Entity\Movie")
    */
    private $movies;


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
     * Set prenom
     *
     * @param string $prenom
     * @return Actor
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Actor
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set image
     *
     * @param \Troiswa\TestBundle\Entity\Image $image
     * @return Actor
     */
    public function setImage(\Troiswa\TestBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Troiswa\TestBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->movies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add movies
     *
     * @param \Troiswa\TestBundle\Entity\Movie $movies
     * @return Actor
     */
    public function addMovie(\Troiswa\TestBundle\Entity\Movie $movies)
    {
        die('addmovie');
        if (!$this->movies->contains($movies))
        {
            $this->movies[] = $movies;
            $movies->addActor($this);
        }

        return $this;
    }

    /**
     * Remove movies
     *
     * @param \Troiswa\TestBundle\Entity\Movie $movies
     */
    public function removeMovie(\Troiswa\TestBundle\Entity\Movie $movies)
    {
        die('removemovie');
        $this->movies->removeElement($movies);
        $movies->removeActor($this);
    }

    /**
     * Get movies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMovies()
    {
        return $this->movies;
    }

    public function __toString()
    {
        return $this->prenom.'-'.$this->nom;
    }
}
