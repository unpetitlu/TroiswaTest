<?php

namespace Troiswa\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Seance
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
    * @ORM\ManyToOne(targetEntity="Troiswa\TestBundle\Entity\Movie")
    */
    private $movie;

    /**
    * @ORM\ManyToOne(targetEntity="Troiswa\TestBundle\Entity\Cinema")
    */
    private $cinema;

    /**
    * @ORM\Column(name="date_seance", type="datetime")
    */
    private $dateseance;

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
     * Set dateseance
     *
     * @param \DateTime $dateseance
     * @return Seance
     */
    public function setDateseance($dateseance)
    {
        $this->dateseance = $dateseance;

        return $this;
    }

    /**
     * Get dateseance
     *
     * @return \DateTime 
     */
    public function getDateseance()
    {
        return $this->dateseance;
    }

    /**
     * Set movie
     *
     * @param \Troiswa\TestBundle\Entity\Movie $movie
     * @return Seance
     */
    public function setMovie(\Troiswa\TestBundle\Entity\Movie $movie = null)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get movie
     *
     * @return \Troiswa\TestBundle\Entity\Movie 
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set cinema
     *
     * @param \Troiswa\TestBundle\Entity\Cinema $cinema
     * @return Seance
     */
    public function setCinema(\Troiswa\TestBundle\Entity\Cinema $cinema = null)
    {
        $this->cinema = $cinema;

        return $this;
    }

    /**
     * Get cinema
     *
     * @return \Troiswa\TestBundle\Entity\Cinema 
     */
    public function getCinema()
    {
        return $this->cinema;
    }
}
