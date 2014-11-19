<?php

namespace MDurys\GupekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use MDurys\GupekBundle\Entity\Meeting;

class MeetingController extends Controller
{
    /**
     * @Route("/meeting")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('MDurysGupekBundle:Meeting:index.html.twig', []);
    }

    /**
     * @Route("/meeting/{id}")
     * @Method("GET")
     */
    public function showAction(Meeting $meeting)
    {
        return $this->render('MDurysGupekBundle:Meeting:show.html.twig', ['meeting' => $meeting]);
    }
}
