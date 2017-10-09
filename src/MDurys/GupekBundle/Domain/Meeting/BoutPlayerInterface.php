<?php

declare(strict_types=1);

namespace MDurys\GupekBundle\Domain\Meeting;

interface BoutPlayerInterface
{
    public function getPlayerId(): int;

    public function getPlace(): int;

    public function setPlace(int $place): self;
}