<?php

namespace MDurys\GupekBundle\Domain\Game;

interface GameInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return int
     */
    public function getMinPlayers(): int;

    /**
     * @return int
     */
    public function getMaxPlayers(): int;
}
