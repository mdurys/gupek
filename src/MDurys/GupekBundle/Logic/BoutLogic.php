<?php

namespace MDurys\GupekBundle\Logic;

use MDurys\GupekBundle\Entity\Bout;

class BoutLogic extends BaseLogic
{
    /**
     * Calculate user scores for given bout.
     *
     * Scoring algorhythm: winner gets as many points as there were players.
     * Second best player gets 2 points less than the winner. Each
     * subsequent players get 1 point less.
     *
     * @param \MDurys\GupekBundle\Entity\Bout $bout
     */
    public function calculateScores(Bout $bout)
    {
        $em = $this->getEntityManager();

        if (0 == $numberOfPlayers = $bout->getMeetingUsers()->count()) {
            throw new Exception\BoutException('no_players');
        }

        // calculate score for each place
        $placeData = [];
        for ($n = 1; $n < $numberOfPlayers + 1; $n++) {
            $placeData[$n]['points'] = $n == 1
                ? $numberOfPlayers
                : $numberOfPlayers - $n;
            $placeData[$n]['players'] = 0;
        }

        // count how many players got given place
        foreach ($bout->getMeetingUsers() as $mu) {
            if (null === $mu->getPlace()) {
                throw new Exception\BoutException('no_place');
            }
            if ($mu->getPlace() < 1 || $mu->getPlace() > $numberOfPlayers) {
                throw new Exception\BoutException('illegal_place');
            }
            $placeData[$mu->getPlace()]['players']++;
        }

        // calculate score for each player
        foreach ($bout->getMeetingUsers() as $mu) {
            if ($placeData[$mu->getPlace()]['players'] == 1) {
                $score = $placeData[$mu->getPlace()]['points'];
            } else {
                $score = 0;
                $place = $mu->getPlace();
                for ($n = $place; $n < $place + $placeData[$place]['players']; $n++) {
                    $score += $placeData[$n]['points'];
                }
                $score = $score / $placeData[$place]['players'];
            }
            $mu
                ->setScore($score)
                ->setWin($mu->getPlace() == 1 ? 1 / $placeData[1]['players'] : 0);
            $em->persist($mu);
        }
    }
}
