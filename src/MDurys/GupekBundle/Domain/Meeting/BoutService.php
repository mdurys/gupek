<?php

declare(strict_types=1);

namespace MDurys\GupekBundle\Domain\Meeting;

class BoutService
{
    /**
     * @param BoutInterface $bout
     * @param array $places
     * @return BoutPlayerInterface[]
     */
    public function assignPlaces(BoutInterface $bout, array $places): array
    {
        $players = $bout->getPlayers();
        $noPlayers = count($players);

        if ($noPlayers < count($places)) {
            throw new \RuntimeException('There are more places than players');
        }
        if ($noPlayers > count($places)) {
            throw new \RuntimeException('There are more players than places');
        }

        foreach ($players as $player) {
            if (!isset($places[$player->getPlayerId()])) {
                throw new \RuntimeException("Player {$player->getPlayerId()} was not assigned a place");
            }
            if ($noPlayers < $places[$player->getPlayerId()]) {
                throw new \RuntimeException('Place is outside range');
            }
            if (0 >= $places[$player->getPlayerId()]) {
                throw new \RuntimeException('Place is outside range');
            }
            $player->setPlace($places[$player->getPlayerId()]);
        }

        return $players;
    }
}