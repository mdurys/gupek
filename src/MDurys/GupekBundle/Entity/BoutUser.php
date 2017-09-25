<?php

declare(strict_types=1);

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class BoutUser
 *
 * @ORM\Table(name="bout_users")
 * @ORM\Entity()
 * @package MDurys\GupekBundle\Entity
 */
class BoutUser
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
     * @ORM\ManyToOne(targetEntity="Bout")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $bout;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="place", type="smallint", nullable=true)
     * @Assert\Range(min="1", minMessage="bout.illegal_place")
     * @Assert\Expression("this.getPlace() <= this.getBout().getMeetingUsers().count()", message="bout.illegal_place")
     */
    private $place;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getBout()
    {
        return $this->bout;
    }

    /**
     * @param mixed $bout
     * @return BoutUser
     */
    public function setBout($bout)
    {
        $this->bout = $bout;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return BoutUser
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlace(): int
    {
        return $this->place;
    }

    /**
     * @param int $place
     * @return BoutUser
     */
    public function setPlace(int $place): BoutUser
    {
        $this->place = $place;
        return $this;
    }

}