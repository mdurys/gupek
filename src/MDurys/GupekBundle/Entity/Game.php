<?php

declare(strict_types=1);

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MDurys\GupekBundle\Domain\Game\GameInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Game
 *
 * @ORM\Table(name="games")
 * @ORM\Entity(repositoryClass="MDurys\GupekBundle\Entity\GameRepository")
 */
class Game implements GameInterface
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
     * @ORM\Column(name="slug", type="string", length=100, unique=true)
     * @Gedmo\Slug(fields={"name"}, updatable=true)
     */
    private $slug;

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
     * @Assert\Expression("this.getMinPlayers() <= this.getMaxPlayers()", message="game.min_players.too_high")
     */
    private $minPlayers;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_players", type="smallint")
     * @Assert\Range(min="1")
     * @Assert\Expression("this.getMaxPlayers() >= this.getMinPlayers()", message="game.max_players.too_low")
     */
    private $maxPlayers;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Game
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set minPlayers
     *
     * @param integer $minPlayers
     * @return Game
     */
    public function setMinPlayers(int $minPlayers)
    {
        $this->minPlayers = $minPlayers;

        return $this;
    }

    /**
     * Get minPlayers
     *
     * @return integer 
     */
    public function getMinPlayers(): int
    {
        return $this->minPlayers;
    }

    /**
     * Set maxPlayers
     *
     * @param integer $maxPlayers
     * @return Game
     */
    public function setMaxPlayers(int $maxPlayers)
    {
        $this->maxPlayers = $maxPlayers;

        return $this;
    }

    /**
     * Get maxPlayers
     *
     * @return integer
     */
    public function getMaxPlayers(): int
    {
        return $this->maxPlayers;
    }
}
