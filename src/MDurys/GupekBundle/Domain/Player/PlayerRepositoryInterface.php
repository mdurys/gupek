<?php

namespace MDurys\GupekBundle\Domain\Player;

use MDurys\GupekBundle\Domain\Meeting\MeetingInterface;

interface PlayerRepositoryInterface
{
    /**
     * @param MeetingInterface $meeting
     * @return array
     */
    public function getByMeeting(MeetingInterface $meeting): array;
}
