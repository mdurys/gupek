<?php

namespace MDurys\GupekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use MDurys\GupekBundle\Entity\Game;
use MDurys\GupekBundle\Form\GameType;

/**
 * Game controller.
 *
 * @Route("/game")
 */
class GameController extends Controller
{
    /**
     * @Route("/", name="game_index")
     * @Method("GET")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('MDurysGupekBundle:Game:index.html.twig', []);
    }

    /**
     * Creates a new Game entity.
     *
     * @Route("/", name="game_create")
     * @Method("POST")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $game = new Game();
        $form = $this->createCreateForm($game);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            return $this->redirectToRoute('game_show', ['id' => $game->getSlug()]);
        }

        return $this->render('MDurysGupekBundle:Bout:new.html.twig', [
            'bout' => $game,
            'form' => $form->createView()
        ]);
    }

    /**
     * Creates a form to create a Game entity.
     *
     * @param Game $game
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Game $game)
    {
        $form = $this->createForm(new GameType(), $game, [
            'action' => $this->generateUrl('game_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'form.button.create']);

        return $form;
    }

    /**
     * Displays a form to create a new Game entity.
     *
     * @Route("/new", name="game_new")
     * @Method("GET")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $game = new Game();
        $form  = $this->createCreateForm($game);

        return $this->render('MDurysGupekBundle:Game:new.html.twig', [
            'game' => $game,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{slug}", name="game_show")
     * @Method("GET")
     *
     * @param Game $game
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Game $game)
    {
        return $this->render('MDurysGupekBundle:Game:show.html.twig', compact('game'));
    }
}
