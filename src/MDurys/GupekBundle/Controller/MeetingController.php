<?php

namespace MDurys\GupekBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MDurys\GupekBundle\Entity\Meeting;
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
     * @Route("/", name="meeting_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $meeting = new Meeting();
        $form = $this->createCreateForm($meeting);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($meeting);
            $em->flush();

            return $this->redirect($this->generateUrl('mdurys_gupek_meeting_show', ['id' => $meeting->getId()]));
        }

        return $this->render('MDurysGupekBundle:Meeting:new.html.twig', [
            'meeting' => $meeting,
            'form'   => $form->createView()
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
        $form = $this->get('gupek.logic.meeting')->createCreateForm($entity);
        $form->add('submit', 'submit', ['label' => 'form.button.create']);

        return $form;
    }

    /**
     * Displays a form to create a new Meeting entity.
     *
     * @Route("/new")
     * @Method("GET")
     */
    public function newAction()
    {
        $meeting = new Meeting();
        $meeting->setDate(new \DateTime());
        $form   = $this->createCreateForm($meeting);

        return $this->render('MDurysGupekBundle:Meeting:new.html.twig', [
            'meeting' => $meeting,
            'form'   => $form->createView()
            ]);
    }

    /**
     * Displays a form to edit an existing Meeting entity.
     *
     * @Route("/edit/{id}")
     * @Method("GET")
     */
    public function editAction(Meeting $meeting)
    {
        $editForm = $this->createEditForm($meeting);
        $deleteForm = $this->createDeleteForm($meeting->getId());

        return $this->render('MDurysGupekBundle:Meeting:edit.html.twig', [
            'entity'      => $meeting,
            'edit_form'   => $editForm->createView(),
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
        $form = $this->createForm(new MeetingType(), $entity, [
            'action' => $this->generateUrl('mdurys_gupek_meeting_update', ['id' => $entity->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'form.button.update']);

        return $form;
    }

    /**
     * Edits an existing Meeting entity.
     *
     * @Route("/{id}")
     * @Method("PUT")
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

            return $this->redirect($this->generateUrl('mdurys_gupek_meeting_edit', ['id' => $id]));
        }

        return $this->render('MDurysGupekBundle:Meeting:edit.html.twig', [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            ]);
    }

    /**
     * Add currently logged in user to meeting.
     *
     * @Route("/join/{id}")
     * @Method("GET")
     */
    public function joinAction(Meeting $meeting)
    {
        $logic = $this->get('gupek.logic.meeting');
        $user = $this->getUser();

        try {
            $logic->addUser($meeting, $user);
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('success', 'meeting.message.user_join');
        } catch (MeetingException $e) {
            $this->get('session')->getFlashBag()->add('error', $e->getTransMessage());
        }

        return $this->redirect($this->generateUrl('mdurys_gupek_meeting_show', ['id' => $meeting->getId()]));
    }

    /**
     * Remove currently logged in user from meeting.
     *
     * @Route("/leave/{id}")
     * @Method("GET")
     */
    public function leaveAction(Meeting $meeting)
    {
        $logic = $this->get('gupek.logic.meeting');
        $user = $this->getUser();

        try {
            $logic->removeUser($meeting, $user);
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('success', 'meeting.message.user_leave');
        } catch (MeetingException $e) {
            $this->get('session')->getFlashBag()->add('error', $e->getTransMessage());
        }

        return $this->redirect($this->generateUrl('mdurys_gupek_meeting_show', ['id' => $meeting->getId()]));
    }

    /**
     * @Route("/{id}")
     * @Method("GET")
     */
    public function showAction(Meeting $meeting)
    {
        $em = $this->getDoctrine()->getManager();
        $bouts = $em->getRepository('MDurysGupekBundle:Bout')
            ->getJoinUserAndGameByMeeting($meeting);
        return $this->render('MDurysGupekBundle:Meeting:show.html.twig', ['meeting' => $meeting, 'bouts' => $bouts]);
    }

    /**
     * Deletes a Meeting entity.
     *
     * @Route("/{id}", name="meeting_delete")
     * @Method("DELETE")
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

        return $this->redirect($this->generateUrl('meeting'));
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
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => 'form.button.delete'])
            ->getForm()
        ;
    }
}
