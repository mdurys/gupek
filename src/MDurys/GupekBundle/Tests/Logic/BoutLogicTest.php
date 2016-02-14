<?php

namespace MDurys\GupekBundle\Tests\Logic;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use MDurys\GupekBundle\Entity\Bout;
use MDurys\GupekBundle\Entity\Meeting;
use MDurys\GupekBundle\Entity\MeetingUser;
use MDurys\GupekBundle\Entity\User;
use MDurys\GupekBundle\Logic\Exception\BoutException;

class BoutLogicTest extends LogicTestCase
{
    /**
     * @var \MDurys\GupekBundle\Logic\BoutLogic
     */
    private $logic;

    public function setUp()
    {
        parent::setUp();
        $this->logic = $this->getContainer()->get('gupek.logic.bout');
    }

    public function testAddUser()
    {
        $bout = new Bout();
        $bout->setMaxPlayers(3);
        $meeting = new Meeting();
        $meeting->addBout($bout);
        // $user1 = new User();

        // $bout = $this->prophesize('MDurys\GupekBundle\Entity\Bout');
        // $bout->getId()->willReturn(1);
        // $bout->getMeeting()->willReturn(null);
        // $bout->getMaxPlayers()->willReturn(3);

        for ($n = 1; $n <= 4; $n++) {
            $var = 'user'.$n;
            $$var = $this->prophesize('MDurys\GupekBundle\Entity\User');
            $$var->getId()->willReturn($n);
        }

        // bout needs to be assigned to a meeting
        try {
            $this->logic->addUser($bout, $user1->reveal());
            $this->fail('An expected exception has not been raised.');
        } catch (BoutException $e) {
            $this->assertEquals('no_meeting', $e->getMessage());
        }

        // this time user should be added to bout
        $bout->setMeeting($meeting);
        $mu = $this->logic->addUser($bout, $user1->reveal());
        $this->assertInstanceOf('MDurys\GupekBundle\Entity\MeetingUser', $mu);
        $this->assertCount(1, $bout->getMeetingUsers());

        // $bout->getMeeting()->willReturn($meeting);
        // $bout->getMeetingUsers()->willReturn([]);
        // $bout->addMeetingUser(\Prophecy\Argument::type('MDurys\GupekBundle\Entity\MeetingUser'))->shouldBeCalled();

        // it should not possible to add the same user twice
        try {
            $this->logic->addUser($bout, $user1->reveal());
            $this->fail('An expected exception has not been raised.');
        } catch (BoutException $e) {
            $this->assertEquals('already_joined', $e->getMessage());
        }

        // add 2 more users
        $this->logic->addUser($bout, $user2->reveal());
        $this->logic->addUser($bout, $user3->reveal());
        $this->assertCount(3, $bout->getMeetingUsers());

        // adding 4th users should raise an exception
        try {
            $this->logic->addUser($bout, $user4->reveal());
            $this->fail('An expected exception has not been raised.');
        } catch (BoutException $e) {
            $this->assertEquals('max_players', $e->getMessage());
        }

        // $this->logic->addUser($bout, $user4->reveal());
    }

    /**
     * @expectedException \MDurys\GupekBundle\Logic\Exception\BoutException
     * @expectedExceptionMessage no_meeting
     */
    public function testRemoveUserNoMeeting()
    {
        $user = $this->prophesize('MDurys\GupekBundle\Entity\User')->reveal();
        $bout = $this->prophesize('MDurys\GupekBundle\Entity\Bout')->reveal();
        $this->logic->removeUser($bout, $user);
    }

    public function testCalculateScores()
    {
        $bout = new Bout();
        $bout->setMaxPlayers(4);

        // no users in bout
        try {
            $this->logic->calculateScores($bout);
        } catch (BoutException $e) {
            $this->assertEquals('no_players', $e->getMessage());
        }

        $mu1 = new MeetingUser();
        $bout->addMeetingUser($mu1);

        // no place
        try {
            $this->logic->calculateScores($bout);
        } catch (BoutException $e) {
            $this->assertEquals('no_place', $e->getMessage());
        }

        // illegal place
        $mu1->setPlace(99);
        try {
            $this->logic->calculateScores($bout);
        } catch (BoutException $e) {
            $this->assertEquals('illegal_place', $e->getMessage());
        }

        // add remaining players
        $mu2 = new MeetingUser();
        $bout->addMeetingUser($mu2);
        $mu3 = new MeetingUser();
        $bout->addMeetingUser($mu3);
        $mu4 = new MeetingUser();
        $bout->addMeetingUser($mu4);

        // case: each players gets a separate place
        $mu1->setPlace(1);
        $mu2->setPlace(2);
        $mu3->setPlace(3);
        $mu4->setPlace(4);
        $this->logic->calculateScores($bout);

        $this->assertEquals(4, $mu1->getScore());
        $this->assertEquals(2, $mu2->getScore());
        $this->assertEquals(1, $mu3->getScore());
        $this->assertEquals(0, $mu4->getScore());
        $this->assertEquals(1, $mu1->getWin());
        $this->assertEquals(0, $mu2->getWin());
        $this->assertEquals(0, $mu3->getWin());
        $this->assertEquals(0, $mu4->getWin());

        // case: two winners
        $mu1->setPlace(1);
        $mu2->setPlace(1);
        $mu3->setPlace(3);
        $mu4->setPlace(4);
        $this->logic->calculateScores($bout);

        $this->assertEquals(3, $mu1->getScore());
        $this->assertEquals(3, $mu2->getScore());
        $this->assertEquals(1, $mu3->getScore());
        $this->assertEquals(0, $mu4->getScore());
        $this->assertEquals(0.5, $mu1->getWin());
        $this->assertEquals(0.5, $mu2->getWin());
        $this->assertEquals(0, $mu3->getWin());
        $this->assertEquals(0, $mu4->getWin());

        // case: one winner, all others on 2nd place
        $mu1->setPlace(1);
        $mu2->setPlace(2);
        $mu3->setPlace(2);
        $mu4->setPlace(2);
        $this->logic->calculateScores($bout);

        $this->assertEquals(4, $mu1->getScore());
        $this->assertEquals(1, $mu2->getScore());
        $this->assertEquals(1, $mu3->getScore());
        $this->assertEquals(1, $mu4->getScore());
        $this->assertEquals(1, $mu1->getWin());
        $this->assertEquals(0, $mu2->getWin());
        $this->assertEquals(0, $mu3->getWin());
        $this->assertEquals(0, $mu4->getWin());

        // case: two 2nd places
        $mu1->setPlace(1);
        $mu2->setPlace(2);
        $mu3->setPlace(2);
        $mu4->setPlace(4);
        $this->logic->calculateScores($bout);

        $this->assertEquals(4, $mu1->getScore());
        $this->assertEquals(1.5, $mu2->getScore());
        $this->assertEquals(1.5, $mu3->getScore());
        $this->assertEquals(0, $mu4->getScore());
        $this->assertEquals(1, $mu1->getWin());
        $this->assertEquals(0, $mu2->getWin());
        $this->assertEquals(0, $mu3->getWin());
        $this->assertEquals(0, $mu4->getWin());
    }
}
