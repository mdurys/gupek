<?php

namespace MDurys\GupekBundle\Domain\Meeting;

interface MeetingInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime;
}
