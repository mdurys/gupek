<?php

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MDurys\GupekBundle\Domain\Meeting\SeasonInterface;

/**
 * Season
 *
 * @ORM\Table(name="seasons")
 * @ORM\Entity(repositoryClass="MDurys\GupekBundle\Entity\SeasonRepository")
 */
class Season implements SeasonInterface
{
    // attendence required to be classified in a season
    const MIN_ATTENDANCE = 10;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    public function __toString()
    {
        return strval($this->id);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }
}
