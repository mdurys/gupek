<?php

namespace MDurys\GupekBundle\Logic;

use MDurys\GupekBundle\Entity\Bout;

class BoutLogic extends BaseLogic
{
    /**
     * Calculate user scores for given bout.
     *
     * @param \MDurys\GupekBundle\Entity\Bout $bout
     */
    public function calculateScores(Bout $bout)
    {
        $em = $this->getEntityManager();
        $numberOfPlayers = $bout->getMeetingUsers()->count();
var_dump($numberOfPlayers);

        foreach ($bout->getMeetingUsers() as $mu) {
            if (!$mu->getPlace()) {
                continue;
            }

            $score = $mu->getPlace() == 1
                ? $numberOfPlayers
                : max(0, $numberOfPlayers - $mu->getPlace());
            $mu->setScore($score);
            $em->persist($mu);
        }
    }
}
