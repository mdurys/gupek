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
        $numberOfPlayers = $bout->getMeetingUsers()->count();

        // calculate score for each place
        $placeToPoints = [];
        for ($n = 1; $n < $numberOfPlayers + 1; $n++) {
            $placeToPoints[$n]['points'] = $n == 1
                ? $numberOfPlayers
                : $numberOfPlayers - $n;
            $placeToPoints[$n]['players'] = 0;
        }

        // count how many players got given place
        foreach ($bout->getMeetingUsers() as $mu) {
            if (null === $mu->getPlace()) {
                throw new Exception\BoutException('no_place');
            }
            if ($mu->getPlace() < 1 || $mu->getPlace() > $numberOfPlayers) {
                throw new Exception\BoutException('illegal_place');
            }
            $placeToPoints[$mu->getPlace()]['players']++;
        }

        // calculate score for each player
        foreach ($bout->getMeetingUsers() as $mu) {
            if ($placeToPoints[$mu->getPlace()]['players'] == 1) {
                $score = $placeToPoints[$mu->getPlace()]['points'];
            } else {
                $score = 0;
                $place = $mu->getPlace();
                for ($n = $place; $n < $place + $placeToPoints[$place]['players']; $n++) {
                    $score += $placeToPoints[$n]['points'];
                }
                $score = $score / $placeToPoints[$place]['players'];
            }
            $mu->setScore($score);
            $em->persist($mu);
        }
    }
}
