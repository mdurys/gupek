<?php

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Meeting
 *
 * @ORM\Table(name="meetings")
 * @ORM\Entity(repositoryClass="MDurys\GupekBundle\Entity\MeetingRepository")
 */
class Meeting
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\NotBlank()
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="MDurys\GupekBundle\Entity\Season")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @Assert\NotNull()
     */
    private $season;


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
     * Set date
     *
     * @param \DateTime $date
     * @return Meeting
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set season
     *
     * @param \MDurys\GupekBundle\Entity\Season $season
     * @return Meeting
     */
    public function setSeason(\MDurys\GupekBundle\Entity\Season $season = null)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season
     *
     * @return \MDurys\GupekBundle\Entity\Season
     */
    public function getSeason()
    {
        return $this->season;
    }
}
