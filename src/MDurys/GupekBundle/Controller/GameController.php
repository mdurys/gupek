<?php

namespace MDurys\GupekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use MDurys\GupekBundle\Entity\Game;

/**
 * Game controller.
 *
 * @Route("/game")
 */
class GameController extends Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('MDurysGupekBundle:Game:index.html.twig', []);
    }

    /**
     * @Route("/{slug}")
     * @Method("GET")
     */
    public function showAction(Game $game)
    {
        return $this->render('MDurysGupekBundle:Game:show.html.twig', compact('game'));
    }
}
