<?php

namespace MDurys\GupekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GameController extends Controller
{
    /**
     * @Route("/game")
     */
    public function indexAction($name)
    {
        return $this->render('MDurysGupekBundle:Game:index.html.twig', []);
    }
}
