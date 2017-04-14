<?php

namespace MDurys\GupekBundle\Domain\Meeting;

/**
 * Interface MeetingRepositoryInterface
 * @package MDurys\GupekBundle\Domain\Meeting
 */
interface MeetingRepositoryInterface
{
    /**
     * Get meetings from given season.
     *
     * @param SeasonInterface $season
     * @return MeetingInterface[]
     */
    public function getBySeason(SeasonInterface $season): array;
}
