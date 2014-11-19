<?php

namespace MDurys\GupekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use MDurys\GupekBundle\Entity\Season;

class SeasonController extends Controller
{
    /**
     * @Route("/season")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('MDurysGupekBundle:Season:index.html.twig', []);
    }

    /**
     * @Route("/season/{id}")
     * @Method("GET")
     */
    public function showAction(Season $season)
    {
        return $this->render('MDurysGupekBundle:Season:show.html.twig', ['season' => $season]);
    }
}
