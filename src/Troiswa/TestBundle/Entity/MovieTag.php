<?php

namespace Troiswa\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class MovieTag
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Troiswa\TestBundle\Entity\Movie", inversedBy="tags")
     */
    private $movie;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Troiswa\TestBundle\Entity\Tag")
     */
    private $tag;

    /**
     * Set movie
     *
     * @param \Troiswa\TestBundle\Entity\Movie $movie
     * @return MovieTag
     */
    public function setMovie(\Troiswa\TestBundle\Entity\Movie $movie)
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
     * Set tag
     *
     * @param \Troiswa\TestBundle\Entity\Tag $tag
     * @return MovieTag
     */
    public function setTag(\Troiswa\TestBundle\Entity\Tag $tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \Troiswa\TestBundle\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }
}
