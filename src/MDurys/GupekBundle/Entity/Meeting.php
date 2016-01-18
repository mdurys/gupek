<?php

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Meeting
 *
 * @ORM\Table(name="meetings")
 * @ORM\Entity(repositoryClass="MDurys\GupekBundle\Entity\MeetingRepository")
 * @UniqueEntity("date")
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
     * @ORM\ManyToOne(targetEntity="Season")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $season;

    /**
     * @ORM\OneToMany(targetEntity="MeetingUser", mappedBy="meeting")
     */
    private $meetingUsers;

    /**
     * @ORM\OneToMany(targetEntity="Bout", mappedBy="meeting")
     */
    private $bouts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->meetingUsers = new ArrayCollection();
        $this->bouts = new ArrayCollection();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return $this
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
     * @param Season $season
     *
     * @return $this
     */
    public function setSeason(Season $season = null)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season
     *
     * @return Season
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Add meetingUser
     *
     * @param MeetingUser $meetingUser
     *
     * @return $this
     */
    public function addMeetingUser(MeetingUser $meetingUser)
    {
        $this->meetingUsers[] = $meetingUser;

        return $this;
    }

    /**
     * Remove meetingUser
     *
     * @param MeetingUser $meetingUser
     */
    public function removeMeetingUser(MeetingUser $meetingUser)
    {
        $this->meetingUsers->removeElement($meetingUser);
    }

    /**
     * Get meetingUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeetingUsers()
    {
        return $this->meetingUsers;
    }

    /**
     * Add bouts
     *
     * @param \MDurys\GupekBundle\Entity\Bout $bouts
     *
     * @return $this
     */
    public function addBout(Bout $bout)
    {
        $this->bouts[] = $bout;

        return $this;
    }

    /**
     * Remove bout
     *
     * @param Bout $bout
     */
    public function removeBout(Bout $bout)
    {
        $this->bouts->removeElement($bout);
    }

    /**
     * Get bouts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBouts()
    {
        return $this->bouts;
    }
}
