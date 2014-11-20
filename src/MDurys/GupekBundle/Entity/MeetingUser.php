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
     * @ORM\ManyToOne(targetEntity="MDurys\GupekBundle\Entity\Meeting")
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
     * @ORM\ManyToOne(targetEntity="MDurys\GupekBundle\Entity\Bout")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $bout;

    /**
     * @var integer
     *
     * @ORM\Column(name="place", type="integer", nullable=true)
     */
    private $place;


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
    public function setMeeting(\MDurys\GupekBundle\Entity\Meeting $meeting = null)
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
    public function setUser(\MDurys\GupekBundle\Entity\User $user = null)
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
    public function setBout(\MDurys\GupekBundle\Entity\Bout $bout = null)
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
}
