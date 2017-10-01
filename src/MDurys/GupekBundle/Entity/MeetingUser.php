<?php

declare(strict_types=1);

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
     * @ORM\ManyToOne(targetEntity="Meeting")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $meeting;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="smallint", nullable=false)
     */
    private $status;

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
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return MeetingUser
     */
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }
}
