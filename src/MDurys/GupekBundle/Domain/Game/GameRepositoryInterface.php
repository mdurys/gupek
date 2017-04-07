<?php

namespace MDurys\GupekBundle\Domain\Game;

interface GameRepositoryInterface
{
    /**
     * @param string $slug
     * @return GameInterface
     */
    public function getBySlug(string $slug): GameInterface;
}
