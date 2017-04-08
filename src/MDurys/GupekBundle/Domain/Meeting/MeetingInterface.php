<?php

namespace MDurys\GupekBundle\Domain\Meeting;

use MDurys\GupekBundle\Domain\Player\PlayerInterface;

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

    /**
     * @param PlayerInterface $player
     *
     * @return bool
     */
    public function addPlayer(PlayerInterface $player): bool;

    /**
     * @param PlayerInterface $player
     *
     * @return bool
     */
    public function removePlayer(PlayerInterface $player): bool;
}
