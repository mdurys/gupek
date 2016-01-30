<?php

namespace MDurys\GupekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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
            $this->get('braincrafted_bootstrap.flash')->success('game.message.created');

            return $this->redirectToRoute('game_show', ['slug' => $game->getSlug()]);
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
        $form = $this->createForm(GameType::class, $game, [
            'action' => $this->generateUrl('game_create'),
            'method' => Request::METHOD_POST,
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'form.button.create']);

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
     * Displays a form to edit an existing Game entity.
     *
     * @Route("/{id}/edit", name="game_edit")
     * @Method("GET")
     *
     * @param Game $game
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Game $game)
    {
        $editForm = $this->createEditForm($game);
//        $deleteForm = $this->createDeleteForm($game->getId());

        return $this->render('MDurysGupekBundle:Game:edit.html.twig', [
            'entity'      => $game,
            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Creates a form to edit a Bout entity.
     *
     * @param Game $game The entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Game $game)
    {
        $form = $this->createForm(GameType::class, $game, [
            'action' => $this->generateUrl('game_update', ['id' => $game->getId()]),
            'method' => Request::METHOD_PUT,
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'form.button.update']);

        return $form;
    }

    /**
     * Edits an existing Game entity.
     *
     * @Route("/{id}", name="game_update")
     * @Method("PUT")
     *
     * @param Request $request
     * @param Game $game
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, Game $game)
    {
//        $deleteForm = $this->createDeleteForm($id);
        $form = $this->createEditForm($game);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->get('braincrafted_bootstrap.flash')->success('game.message.updated');

            return $this->redirectToRoute('game_edit', ['id' => $game->getId()]);
        }

        return $this->render('MDurysGupekBundle:Game:edit.html.twig', [
            'entity'      => $game,
            'edit_form'   => $form->createView(),
//            'delete_form' => $deleteForm->createView(),
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
