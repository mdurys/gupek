<?php

namespace MDurys\GupekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use MDurys\GupekBundle\Entity\Game;

class GameController extends Controller
{

    /**
     * @Route("/game")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('MDurysGupekBundle:Game:index.html.twig', []);
    }

    /**
     * @Route("/game/{slug}")
     * @Method("GET")
     */
    public function showAction(Game $game)
    {
        return $this->render('MDurysGupekBundle:Game:show.html.twig', ['game' => $game]);
    }
}
