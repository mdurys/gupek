<?php

namespace MDurys\GupekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use MDurys\GupekBundle\Entity\Season;

/**
 * @Route("/season")
 */
class SeasonController extends Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('MDurysGupekBundle:Season:index.html.twig', []);
    }

    /**
     * @Route("/{id}")
     * @Method("GET")
     *
     * @param Season $season
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Season $season)
    {
        $ranking = $this->getDoctrine()
            ->getRepository('MDurysGupekBundle:Season')
            ->getUserRanking($season);
        $meetings = $this->getDoctrine()
            ->getRepository('MDurysGupekBundle:Meeting')
            ->getDetailsBySeason($season->getId());

        return $this->render('MDurysGupekBundle:Season:show.html.twig', compact('season', 'ranking', 'meetings'));
    }
}
