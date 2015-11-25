<?php

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Bout entity represents game session during a metting.
 *
 * During a meeting one or more bouts are played.
 *
 * @ORM\Table(name="bouts")
 * @ORM\Entity(repositoryClass="MDurys\GupekBundle\Entity\BoutRepository")
 */
class Bout
{
    const STATUS_NEW = 1;
    const STATUS_FINISHED = 2;
    const STATUS_ABORTED = 3;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Meeting", inversedBy="bouts")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $meeting;

    /**
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $game;

    /**
     * @ORM\OneToMany(targetEntity="MeetingUser", mappedBy="bout")
     * @Assert\Valid
     */
    private $meetingUsers;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_players", type="smallint")
     * @Assert\Expression("this.getMaxPlayers() >= this.getGame().getMinPlayers()", message="bout.max_players.too_few")
     * @Assert\Expression("this.getMaxPlayers() <= this.getGame().getMaxPlayers()", message="bout.max_players.too_many")
     */
    private $maxPlayers;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->meetingUsers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->status = self::STATUS_NEW;
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
     * Set maxPlayers
     *
     * @param integer $maxPlayers
     * @return Bout
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

    /**
     * Set meeting
     *
     * @param \MDurys\GupekBundle\Entity\Meeting $meeting
     * @return Bout
     */
    public function setMeeting(Meeting $meeting = null)
    {
        $this->meeting = $meeting;

        return $this;
    }

    /**
     * Get meeting
     *
     * @return \MDurys\GupekBundle\Entity\Meeting 
     */
    public function getMeeting()
    {
        return $this->meeting;
    }

    /**
     * Set game
     *
     * @param \MDurys\GupekBundle\Entity\Game $game
     * @return Bout
     */
    public function setGame(Game $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \MDurys\GupekBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Add meetingUser
     *
     * @param \MDurys\GupekBundle\Entity\MeetingUser $meetingUser
     * @return Bout
     */
    public function addMeetingUser(MeetingUser $meetingUser)
    {
        $this->meetingUsers[] = $meetingUser;

        return $this;
    }

    /**
     * Remove meetingUser
     *
     * @param \MDurys\GupekBundle\Entity\MeetingUser $meetingUser
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
     * Set status
     *
     * @param integer $status
     *
     * @return Bout
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Check if status equals new
     *
     * @return boolean
     */
    public function isNew()
    {
        return $this->status == self::STATUS_NEW;
    }

    /**
     * Check if status equals finished
     *
     * @return boolean
     */
    public function isFinished()
    {
        return $this->status == self::STATUS_FINISHED;
    }
}
