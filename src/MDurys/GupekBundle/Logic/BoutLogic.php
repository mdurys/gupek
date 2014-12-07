<?php

namespace MDurys\GupekBundle\Logic;

use MDurys\GupekBundle\Entity\Bout;
use MDurys\GupekBundle\Entity\User;
use MDurys\GupekBundle\Entity\MeetingUser;

class BoutLogic extends BaseLogic
{
    /**
     * Add user to bout.
     *
     * @param \MDurys\GupekBundle\Entity\Bout $bout
     * @param \MDurys\GupekBundle\Entity\User $user
     * @return \MDurys\GupekBundle\Entity\MeetingUser
     * @throws \MDurys\GupekBundle\Logic\Exception\BoutException
     */
    public function addUser(Bout $bout, User $user)
    {
        $em = $this->getEntityManager();

        if (null === $meeting = $bout->getMeeting()) {
            throw new Exception\BoutException('no_meeting');
        }

        if (null !== $meetingUsers = $this->getRepository('MeetingUser')->getByMeetingAndUser($meeting, $user)) {
            // make sure that user doesn't already participate in given bout
            foreach ($meetingUsers as $mu) {
                if ($mu->getBout()->getId() == $bout->getId()) {
                    throw new Exception\BoutException('already_joined');
                }
            }

            // check if player limit is observed
            if (count($meetingUsers) >= $bout->getMaxPlayers()) {
                throw new Exception\BoutException('max_players');
            }

            // search for a MeetingUser entity without a bout
            foreach ($meetingUsers as $mu) {
                if (null === $mu->getBout()) {
                    $mu->setBout($bout);
                    $em->persist($mu);

                    return $mu;
                }
            }
        }

        // crate new MeetingUser entity
        $mu = new MeetingUser();
        $mu
            ->setMeeting($meeting)
            ->setBout($bout)
            ->setUser($user);
        $em->persist($mu);

        return $mu;
    }

    /**
     * Remove user from bout.
     *
     * @param \MDurys\GupekBundle\Entity\Bout $bout
     * @param \MDurys\GupekBundle\Entity\User $user
     * @return boolean TRUE for success
     * @throws \MDurys\GupekBundle\Logic\Exception\BoutException
     * @throws \MDurys\GupekBundle\Logic\Exception\MeetingException
     */
    public function removeUser(Bout $bout, User $user)
    {
        $em = $this->getEntityManager();

        if (null === $meeting = $bout->getMeeting()) {
            throw new Exception\BoutException('no_meeting');
        }

        if (null === $meetingUsers = $this->getRepository('MeetingUser')->getByMeetingAndUser($meeting, $user)) {
            throw new Exception\MeetingException('user_not_joined');
        }

        foreach ($meetingUsers as $mu) {
            if ($mu->getBout()->getId() == $bout->getId()) {
                $bout->removeMeetingUser($mu);
                if (1 == count($meetingUsers)) {
                    // if user takes part in just one bout then we remove him
                    // from this bout but he is still member of a meeting
                    $mu->setBout(null);
                } else {
                    // if he takes part in more than one bout then we simply
                    // delete MeetingUser entity
                    $em->remove($mu);
                }
                $em->persist($bout);

                return true;
            }
        }

        return false;
    }

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
