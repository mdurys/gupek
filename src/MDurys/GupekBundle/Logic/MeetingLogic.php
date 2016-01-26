<?php

namespace MDurys\GupekBundle\Logic;

use MDurys\GupekBundle\Entity\Meeting;
use MDurys\GupekBundle\Entity\MeetingRepository;
use MDurys\GupekBundle\Entity\MeetingUser;
use MDurys\GupekBundle\Entity\MeetingUserRepository;
use MDurys\GupekBundle\Entity\User;
use MDurys\GupekBundle\Form\MeetingType;

class MeetingLogic extends BaseLogic
{
    /**
     * @var MeetingRepository
     */
    private $meetingRepository;

    /**
     * @var MeetingUserRepository
     */
    private $meetingUserRepository;


    /**
     * MeetingLogic constructor.
     *
     * @param MeetingRepository     $meetingRepository
     * @param MeetingUserRepository $meetingUserRepository
     */
    public function __construct(MeetingRepository $meetingRepository, MeetingUserRepository $meetingUserRepository)
    {
        $this->meetingRepository = $meetingRepository;
        $this->meetingUserRepository = $meetingUserRepository;
    }

    /**
     * Check if given user participates in a meeting.
     *
     * @param Meeting $meeting
     * @param User    $user
     *
     * @return bool
     */
    public function isUserParticipating(Meeting $meeting, User $user)
    {
        foreach ($meeting->getMeetingUsers() as $mu) {
            if ($mu->getUser() == $user) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add user to meeting.
     *
     * @param Meeting $meeting
     * @param User    $user
     *
     * @return MeetingUser
     * @throws \MDurys\GupekBundle\Logic\Exception\MeetingException
     */
    public function addUser(Meeting $meeting, User $user)
    {
        if (true === $this->isUserParticipating($meeting, $user)) {
            throw new Exception\MeetingException('user_already_joined');
        }

        $mu = new MeetingUser();
        $mu
            ->setMeeting($meeting)
            ->setUser($user);
        $meeting->addMeetingUser($mu);

        return $mu;
    }

    /**
     * Remove user from meeting.
     *
     * @param Meeting $meeting
     * @param User    $user
     *
     * @return MeetingUser|mixed
     * @throws \MDurys\GupekBundle\Logic\Exception\MeetingException
     */
    public function removeUser(Meeting $meeting, User $user)
    {
//        $em = $this->getEntityManager();

        // if (false === $this->isUserParticipating($meeting, $user)) {
        //     throw new Exception\MeetingException('user_not_joined');
        // }
//        $result = $this->getRepository('MeetingUser')->getByMeetingAndUser($meeting, $user);
        $result = $this->meetingUserRepository->getByMeetingAndUser($meeting, $user);
        if (empty($result)) {
            throw new Exception\MeetingException('user_not_joined');
        }

//        $result = $this->getRepository('MeetingUser')->getByMeetingAndUser($meeting, $user);
//        if (empty($result)) {
//            throw new Exception\MeetingException('user_not_joined');
//        }

        foreach ($meeting->getMeetingUsers() as $mu) {
            /** @var \MDurys\GupekBundle\Entity\MeetingUser $mu */
            if (null !== $mu->getPlace()) {
                throw new Exception\MeetingException('user_is_ranked');
            }
            if (null !== $mu->getBout()) {
                throw new Exception\MeetingException('user_is_engaged');
            }
            $meeting->removeMeetingUser($mu);
            return $mu;
//            $em->remove($mu);
        }
    }

    /**
     * Create meeting form.
     *
     * @param Meeting $meeting
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createCreateForm(Meeting $meeting)
    {
        return $this->getFormFactory()
            ->create(MeetingType::class, $meeting, [
                'action' => $this->generateUrl('meeting_create', ['season' => $meeting->getSeason()->getId()]),
                'method' => 'POST'
            ])
            ->remove('season');
    }
}
