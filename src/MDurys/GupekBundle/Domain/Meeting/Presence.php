<?php

namespace MDurys\GupekBundle\Domain\Meeting;

use MDurys\GupekBundle\Domain\Player\PlayerInterface;

/**
 * Class Presence
 * @package MDurys\GupekBundle\Domain\Meeting
 */
class Presence
{
    /**
     * @var string Player is not going to attend the meeting
     */
    const ABSENT = 0;

    /**
     * @var string Player is going to attend the meeting
     */
    const PRESENT = 1;

    /**
     * @var string Player is not sure if he/she is going attend the meeting
     */
    const TENTATIVE = 2;
    /**
     * @var MeetingInterface
     */
    private $meeting;

    /**
     * @var PlayerInterface
     */
    private $player;

    /**
     * @var int
     */
    private $mode;

    /**
     * Presence constructor.
     * @param MeetingInterface $meeting
     * @param PlayerInterface $player
     * @param int $mode
     */
    public function __construct(MeetingInterface $meeting, PlayerInterface $player, int $mode)
    {
        $this->meeting = $meeting;
        $this->player = $player;
        $this->mode = $mode;
    }

    /**
     * @return MeetingInterface
     */
    public function getMeeting(): MeetingInterface
    {
        return $this->meeting;
    }

    /**
     * @return PlayerInterface
     */
    public function getPlayer(): PlayerInterface
    {
        return $this->player;
    }

    /**
     * @return int
     */
    public function getMode(): int
    {
        return $this->mode;
    }
}
