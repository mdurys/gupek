<?php

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * MeetingUser
 *
 * @ORM\Table(name="meetings_users")
 * @ORM\Entity(repositoryClass="MDurys\GupekBundle\Entity\MeetingUserRepository")
 * @UniqueEntity({"meeting", "user", "bout"})
 */
class MeetingUser
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
     * @ORM\ManyToOne(targetEntity="MDurys\GupekBundle\Entity\Meeting", inversedBy="meetingUsers")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $meeting;

    /**
     * @ORM\ManyToOne(targetEntity="MDurys\GupekBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="MDurys\GupekBundle\Entity\Bout", inversedBy="meetingUsers")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $bout;

    /**
     * @var integer
     *
     * @ORM\Column(name="place", type="smallint", nullable=true)
     * @Assert\Range(min="1")
     * @Assert\Expression("this.getPlace() <= this.getBout().getMaxPlayers()", message="bout.illegal_place")
     */
    private $place;

    /**
     * Number of points scored in this bout. Usually it is an integer but in
     * case of a draw it can be a decimal number.
     *
     * @var float
     *
     * @ORM\Column(name="score", type="decimal", scale=4, nullable=true)
     */
    private $score;

    /**
     * Share of win for this bout. Usually only one user wins a game and that
     * counts as 1 win in statistics. If more than one user wins a game 1
     * "win point" is shared between all winning players.
     *
     * @var float
     *
     * @ORM\Column(name="win", type="decimal", scale=4, nullable=true)
     * @Assert\Range(min=0, max=1)
     */
    private $win;

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
     * Set meeting
     *
     * @param \MDurys\GupekBundle\Entity\Meeting $meeting
     * @return MeetingUser
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
     * Set user
     *
     * @param \MDurys\GupekBundle\Entity\User $user
     * @return MeetingUser
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MDurys\GupekBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set bout
     *
     * @param \MDurys\GupekBundle\Entity\Bout $bout
     * @return MeetingUser
     */
    public function setBout(Bout $bout = null)
    {
        $this->bout = $bout;

        return $this;
    }

    /**
     * Get bout
     *
     * @return \MDurys\GupekBundle\Entity\Bout 
     */
    public function getBout()
    {
        return $this->bout;
    }

    /**
     * Set place
     *
     * @param integer $place
     * @return MeetingUser
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return integer 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set score
     *
     * @param float $score
     * @return MeetingUser
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set win
     *
     * @param float $win
     * @return MeetingUser
     */
    public function setWin($win)
    {
        $this->win = $win;

        return $this;
    }

    /**
     * Get win
     *
     * @return float
     */
    public function getWin()
    {
        return $this->win;
    }
}
