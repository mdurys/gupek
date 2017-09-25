<?php

declare(strict_types=1);

namespace MDurys\GupekBundle\Domain\Meeting;

use MDurys\GupekBundle\Domain\Player\PlayerInterface;

interface BoutInterface
{
    /**
     * @var int Bout was newly added
     */
    const NEW = 0;

    /**
     * @var int Bout was finished and can be scored
     */
    const FINISHED = 1;

    /**
     * @var int Bout was aborted and will not be scored
     */
    const ABORTED = 2;

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
