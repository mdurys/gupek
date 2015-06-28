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
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MDurys\GupekBundle\Entity\Meeting", inversedBy="bouts")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $meeting;

    /**
     * @ORM\ManyToOne(targetEntity="MDurys\GupekBundle\Entity\Game")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $game;

    /**
     * @ORM\OneToMany(targetEntity="MDurys\GupekBundle\Entity\MeetingUser", mappedBy="bout")
     */
    private $meetingUsers;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_players", type="integer")
     */
    private $maxPlayers;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->meetingUsers = new \Doctrine\Common\Collections\ArrayCollection();
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
}
