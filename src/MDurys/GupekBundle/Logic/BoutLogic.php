<?php

namespace MDurys\GupekBundle\Logic;

use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use MDurys\GupekBundle\Entity\Bout;
use MDurys\GupekBundle\Entity\User;
use MDurys\GupekBundle\Entity\MeetingUser;

class BoutLogic extends BaseLogic
{
    /**
     * Add user to bout.
     *
     * @param Bout $bout
     * @param User $user
     * @return MeetingUser
     * @throws \MDurys\GupekBundle\Logic\Exception\BoutException
     */
    public function addUser(Bout $bout, User $user)
    {
        $em = $this->getEntityManager();

        // bout has to be assigned to a meeting
        if (null === $meeting = $bout->getMeeting()) {
            throw new Exception\BoutException('no_meeting');
        }

        // make sure that user doesn't already participate in given bout
        foreach ($bout->getMeetingUsers() as $mu) {
            if ($mu->getUser()->getId() == $user->getId()) {
                throw new Exception\BoutException('already_joined');
            }
        }

        // check if player limit is observed
        if (count($bout->getMeetingUsers()) >= $bout->getMaxPlayers()) {
            throw new Exception\BoutException('max_players');
        }

        // search for a MeetingUser entity without a bout
        foreach ($meeting->getMeetingUsers() as $mu) {
            if ($mu->getUser()->getId() == $user->getId()) {
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

        $bout->addMeetingUser($mu);
        $em->persist($bout);

        return $mu;
    }

    /**
     * Remove user from bout.
     *
     * @param Bout $bout
     * @param User $user
     * @return boolean TRUE for success
     * @throws \MDurys\GupekBundle\Logic\Exception\BoutException
     */
    public function removeUser(Bout $bout, User $user)
    {
        $em = $this->getEntityManager();

        if (null === $meeting = $bout->getMeeting()) {
            throw new Exception\BoutException('no_meeting');
        }

        if (null === $meetingUsers = $this->getRepository('MeetingUser')->getByMeetingAndUser($meeting, $user)) {
            throw new Exception\BoutException('user_not_joined');
        }

        foreach ($meetingUsers as $mu) {
            /** @var \MDurys\GupekBundle\Entity\MeetingUser $mu */
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
     * @param Bout $bout
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

        $bout->setStatus(Bout::STATUS_FINISHED);
        $em->persist($bout);
    }

    /**
     * @param $bout
     *
     * @return FormView
     */
    public function createJoinForm($bout)
    {
        return $this->createPresenceForm($bout, Request::METHOD_PUT);
    }

    /**
     * @param $bout
     *
     * @return FormView
     */
    public function createLeaveForm($bout)
    {
        return $this->createPresenceForm($bout, Request::METHOD_DELETE);
    }

    private function createPresenceForm($bout, $method)
    {
        return $this->getFormFactory()->createBuilder()
            ->setAction($this->generateUrl('bout_presence', ['id' => $bout]))
            ->setMethod($method)
            ->add('submit', 'submit', ['label' => Request::METHOD_PUT == $method ? 'form.button.join' : 'form.button.leave'])
            ->getForm()
            ->createView();
    }
}
