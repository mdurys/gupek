<?php

namespace MDurys\GupekBundle\Domain\Meeting;


use MDurys\GupekBundle\Domain\Player\PlayerInterface;

class MeetingService
{
    /**
     * @var MeetingRepositoryInterface
     */
    private $meetingRepository;

    /**
     * MeetingService constructor.
     * @param MeetingRepositoryInterface $meetingRepository
     */
    public function __construct(MeetingRepositoryInterface $meetingRepository)
    {
        $this->meetingRepository = $meetingRepository;
    }

    /**
     * @param MeetingInterface $meeting
     * @param PlayerInterface $player
     * @return bool
     */
    public function addPlayer(MeetingInterface $meeting, PlayerInterface $player): bool
    {
        $meeting->addPlayer($player);

        return true;
    }

    /**
     * @param MeetingInterface $meeting
     * @param PlayerInterface $player
     * @return bool
     */
    public function isPlayerParticipating(MeetingInterface $meeting, PlayerInterface $player): bool
    {
        foreach ($meeting->getPlayers() as $ppp) {
            if ($player->getId() == $ppp->getId()) {
                return true;
            }
        }

        return false;
    }
}