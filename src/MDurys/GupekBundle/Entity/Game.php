<?php

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Game
 *
 * @ORM\Table(name="games")
 * @ORM\Entity
 */
class Game
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
     * @ORM\Column(name="name", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="min_players", type="smallint")
     * @Assert\Range(min="1")
     */
    private $minPlayers;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_players", type="smallint")
     * @Assert\Range(min="1")
     */
    private $maxPlayers;

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
     * Set name
     *
     * @param string $name
     * @return Game
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set minPlayers
     *
     * @param integer $minPlayers
     * @return Game
     */
    public function setMinPlayers($minPlayers)
    {
        $this->minPlayers = $minPlayers;

        return $this;
    }

    /**
     * Get minPlayers
     *
     * @return integer 
     */
    public function getMinPlayers()
    {
        return $this->minPlayers;
    }

    /**
     * Set maxPlayers
     *
     * @param integer $maxPlayers
     * @return Game
     */
    public function setMaxPlayers($maxPlayers)
    {
        $this->maxPlayers = $maxPlayers;

        return $this;
    }

    /**
     * Get maxPlayers
     *
     * @return integer 
     */
    public function getMaxPlayers()
    {
        return $this->maxPlayers;
    }
}
