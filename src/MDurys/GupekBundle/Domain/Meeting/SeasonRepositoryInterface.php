<?php

namespace MDurys\GupekBundle\Domain\Meeting;


interface SeasonRepositoryInterface
{
    /**
     * @param SeasonInterface $season
     *
     * @return array
     */
    public function getInfo(SeasonInterface $season): array;

    /**
     * @param SeasonInterface $season
     *
     * @return array
     */
    public function getPlayerRanking(SeasonInterface $season): array;
}