<?php

namespace MDurys\GupekBundle\Tests\Logic;

use MDurys\GupekBundle\Entity\Meeting;
use MDurys\GupekBundle\Entity\MeetingRepository;
use MDurys\GupekBundle\Entity\MeetingUserRepository;
use MDurys\GupekBundle\Entity\User;
use MDurys\GupekBundle\Entity\MeetingUser;
use MDurys\GupekBundle\Logic\MeetingLogic;

class MeetingLogicTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var MeetingLogic
     */
    private $logic;

    /**
     * @var Meeting
     */
    private $meeting;

    /**
     * @var User
     */
    private $user;

    public function setUp()
    {
        $meetingRepository = $this->prophesize(MeetingRepository::class)->reveal();
        $meetingUserRepository = $this->prophesize(MeetingUserRepository::class)->reveal();
        $this->logic = new MeetingLogic($meetingRepository, $meetingUserRepository);
        $this->meeting = new Meeting();
        $this->user = new User();
    }

    public function testIsUserParticipatingFalse()
    {
        $this->assertFalse($this->logic->isUserParticipating($this->meeting, $this->user));
    }

    public function testIsUserParticipatingTrue()
    {
        $this->givenUserParticipatesInMeeting();
        $this->assertTrue($this->logic->isUserParticipating($this->meeting, $this->user));
    }

    public function testAddUser()
    {
        $result = $this->logic->addUser($this->meeting, $this->user);
        $this->assertInstanceOf(MeetingUser::class, $result);
    }

    /**
     * @expectedException \MDurys\GupekBundle\Logic\Exception\MeetingException
     */
    public function testAddUserTwice()
    {
        $this->givenUserParticipatesInMeeting();
        $this->logic->addUser($this->meeting, $this->user);
    }

//    public function testRemoveUserSuccess()
//    {
//        $this->givenUserParticipatesInMeeting();
//        $result = $this->logic->removeUser($this->meeting, $this->user);
//        $this->assertInstanceOf(MeetingUser::class, $result);
//    }

    private function givenUserParticipatesInMeeting()
    {
        $mu = new MeetingUser();
        $mu
            ->setMeeting($this->meeting)
            ->setUser($this->user);
        $this->meeting->addMeetingUser($mu);
    }
}
