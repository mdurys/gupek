<?php

namespace MDurys\GupekBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MDurys\GupekBundle\Entity\Bout;
use MDurys\GupekBundle\Entity\Meeting;
use MDurys\GupekBundle\Entity\Season;
use MDurys\GupekBundle\Entity\User;
use MDurys\GupekBundle\Form\MeetingType;
use MDurys\GupekBundle\Logic\Exception\MeetingException;

/**
 * Meeting controller.
 *
 * @Route("/meeting")
 * @Security("is_authenticated()")
 */
class MeetingController extends Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('MDurysGupekBundle:Meeting:index.html.twig', []);
    }

    /**
     * Creates a new Meeting entity.
     *
     * @Route("/{season}", name="meeting_create")
     * @Method("POST")
     *
     * @param Request $request
     * @param Season  $season
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, Season $season)
    {
        $meeting = new Meeting();
        $meeting->setSeason($season);
        $form = $this->createCreateForm($meeting);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($meeting);
            $em->flush();

            return $this->redirectToRoute('mdurys_gupek_meeting_show', ['id' => $meeting->getId()]);
        }

        return $this->render('MDurysGupekBundle:Meeting:new.html.twig', [
            'meeting' => $meeting,
            'form' => $form->createView()
        ]);
    }

    /**
     * Creates a form to create a Meeting entity.
     *
     * @param Meeting $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Meeting $entity)
    {
        /** @var \Symfony\Component\Form\Form $form */
        $form = $this->get('gupek.logic.meeting')->createCreateForm($entity);
        $form->add('submit', SubmitType::class, ['label' => 'form.button.create']);

        return $form;
    }

    /**
     * Displays a form to create a new Meeting entity.
     *
     * @Route("/new/{season}")
     * @Method("GET")
     *
     * @param Season $season
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Season $season)
    {
        $meeting = new Meeting();
        $meeting
            ->setSeason($season)
            ->setDate(new \DateTime());
        $form = $this->createCreateForm($meeting);

        return $this->render('MDurysGupekBundle:Meeting:new.html.twig', [
            'meeting' => $meeting,
            'form' => $form->createView()
        ]);
    }

    /**
     * Displays a form to edit an existing Meeting entity.
     *
     * @Route("/edit/{id}")
     * @Method("GET")
     *
     * @param Meeting $meeting
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Meeting $meeting)
    {
        $editForm = $this->createEditForm($meeting);
        $deleteForm = $this->createDeleteForm($meeting->getId());

        return $this->render('MDurysGupekBundle:Meeting:edit.html.twig', [
            'entity' => $meeting,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Creates a form to edit a Meeting entity.
     *
     * @param Meeting $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Meeting $entity)
    {
        $form = $this->createForm(MeetingType::class, $entity, [
            'action' => $this->generateUrl('mdurys_gupek_meeting_update', ['id' => $entity->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'form.button.update']);

        return $form;
    }

    /**
     * Edits an existing Meeting entity.
     *
     * @Route("/{id}")
     * @Method("PUT")
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MDurysGupekBundle:Meeting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meeting entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirectToRoute('mdurys_gupek_meeting_edit', ['id' => $id]);
        }

        return $this->render('MDurysGupekBundle:Meeting:edit.html.twig', [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Add currently logged in user to meeting.
     *
     * @Route("/join/{id}")
     * @Method("GET")
     *
     * @param Meeting $meeting
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function joinAction(Meeting $meeting)
    {
        $logic = $this->get('gupek.logic.meeting');
        $user = $this->getUser();

        try {
            $mu = $logic->addUser($meeting, $user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($mu);
            $em->flush();
            $this->get('braincrafted_bootstrap.flash')->success('meeting.message.user_join');
        } catch (MeetingException $e) {
            $this->get('braincrafted_bootstrap.flash')->error($e->getTransMessage());
        }

        return $this->redirectToRoute('mdurys_gupek_meeting_show', ['id' => $meeting->getId()]);
    }

    /**
     * Remove currently logged in user from meeting.
     *
     * @Route("/leave/{id}")
     * @Method("GET")
     *
     * @param Meeting $meeting
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function leaveAction(Meeting $meeting)
    {
        $logic = $this->get('gupek.logic.meeting');
        $user = $this->getUser();

        try {
            $mu = $logic->removeUser($meeting, $user);
            $em = $this->getDoctrine()->getManager();
            $em->remove($mu);
            $em->flush();
            $this->get('braincrafted_bootstrap.flash')->success('meeting.message.user_leave');
        } catch (MeetingException $e) {
            $this->get('braincrafted_bootstrap.flash')->error($e->getTransMessage());
        }

        return $this->redirectToRoute('mdurys_gupek_meeting_show', ['id' => $meeting->getId()]);
    }

    /**
     * @Route("/{id}")
     * @Method("GET")
     *
     * @param Meeting $meeting
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Meeting $meeting)
    {
        $em = $this->getDoctrine()->getManager();
        $bouts = $em->getRepository(Bout::class)
            ->getJoinUserAndGameByMeeting($meeting);
        $users = $em->getRepository(User::class)
            ->getByMeeting($meeting);

        $logic = $this->get('gupek.logic.meeting');
        $hasUserJoined = $logic->isUserParticipating($meeting, $this->getUser());

        return $this->render('MDurysGupekBundle:Meeting:show.html.twig', compact('meeting', 'users', 'bouts', 'hasUserJoined'));
    }

    /**
     * Deletes a Meeting entity.
     *
     * @Route("/{id}", name="meeting_delete")
     * @Method("DELETE")
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MDurysGupekBundle:Meeting')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Meeting entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirectToRoute('meeting');
    }

    /**
     * Creates a form to delete a Meeting entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('meeting_delete', ['id' => $id]))
            ->setMethod(Request::METHOD_DELETE)
            ->add('submit', 'submit', ['label' => 'form.button.delete'])
            ->getForm();
    }
}
