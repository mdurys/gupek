<?php

namespace MDurys\GupekBundle\Domain\Meeting;

use MDurys\GupekBundle\Domain\Player\PlayerInterface;

interface BoutInterface
{
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

    /**
     * @return PlayerInterface[]
     */
    public function getPlayers(): array;
}
