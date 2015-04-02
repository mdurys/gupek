<?php

namespace MDurys\GupekBundle\Tests\Logic;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use MDurys\GupekBundle\Entity\Bout;
use MDurys\GupekBundle\Entity\User;

class BoutLogicTest extends LogicTestCase
{
    private $logic;

    public function setUp()
    {
        parent::setUp();
        $this->logic = $this->getContainer()->get('gupek.logic.bout');
    }

    /**
     * @expectedException MDurys\GupekBundle\Logic\Exception\BoutException
     * @expectedExceptionMessage no_meeting
     */
    public function testAddUserNoMeeting()
    {
        $user = $this->prophesize('MDurys\GupekBundle\Entity\User')->reveal();
        $bout = $this->prophesize('MDurys\GupekBundle\Entity\Bout')->reveal();
        $this->logic->addUser($bout, $user);
    }

    /**
     * @expectedException MDurys\GupekBundle\Logic\Exception\BoutException
     * @expectedExceptionMessage no_meeting
     */
    public function testRemoveUserNoMeeting()
    {
        $user = $this->prophesize('MDurys\GupekBundle\Entity\User')->reveal();
        $bout = $this->prophesize('MDurys\GupekBundle\Entity\Bout')->reveal();
        $this->logic->removeUser($bout, $user);
    }
}
