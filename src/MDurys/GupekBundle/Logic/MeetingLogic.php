<?php

namespace MDurys\GupekBundle\Logic;

use MDurys\GupekBundle\Entity\Meeting;
use MDurys\GupekBundle\Entity\MeetingUser;
use MDurys\GupekBundle\Entity\User;
use MDurys\GupekBundle\Form\MeetingType;

class MeetingLogic extends BaseLogic
{
    /**
     * Add user to meeting.
     *
     * @param \MDurys\GupekBundle\Entity\Meeting $meeting
     * @param \MDurys\GupekBundle\Entity\User $user
     * @return \MDurys\GupekBundle\Entity\MeetingUser
     * @throws \MDurys\GupekBundle\Logic\Exception\MeetingException
     */
    public function addUser(Meeting $meeting, User $user)
    {
        $em = $this->getEntityManager();

        if ($this->getRepository('MeetingUser')->existsMeetingAndUser($meeting, $user)) {
            throw new Exception\MeetingException('user_already_joined');
        }

        $mu = new MeetingUser();
        $mu
            ->setMeeting($meeting)
            ->setUser($user);
        $em->persist($mu);

        return $mu;
    }

    /**
     * Remove user from meeting.
     *
     * @param \MDurys\GupekBundle\Entity\Meeting $meeting
     * @param \MDurys\GupekBundle\Entity\User $user
     * @throws \MDurys\GupekBundle\Logic\Exception\MeetingException
     */
    public function removeUser(Meeting $meeting, User $user)
    {
        $em = $this->getEntityManager();

        $result = $this->getRepository('MeetingUser')->getByMeetingAndUser($meeting, $user);
        if (empty($result)) {
            throw new Exception\MeetingException('user_not_joined');
        }

        foreach ($result as $mu) {
            if (null !== $mu->getPlace()) {
                throw new Exception\MeetingException('user_is_ranked');
            }
            if (null !== $mu->getBout()) {
                throw new Exception\MeetingException('user_is_engaged');
            }
            $em->remove($mu);
        }
    }

    /**
     * Create meeting form.
     *
     * @param \MDurys\GupekBundle\Entity\Meeting $meeting
     * @return \Symfony\Component\Form\Form The form
     */
    public function createCreateForm(Meeting $meeting)
    {
        return $this->getFormFactory()
            ->create(new MeetingType(), $meeting, [
                'action' => $this->generateUrl('meeting_create'),
                'method' => 'POST'
                ]);
    }
}
