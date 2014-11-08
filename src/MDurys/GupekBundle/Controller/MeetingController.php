<?php

namespace MDurys\GupekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use MDurys\GupekBundle\Entity\Meeting;

class MetingController extends Controller
{
    /**
     * @Route("/meeting")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('MDurysGupekBundle:Meeting:index.html.twig', []);
    }
}
