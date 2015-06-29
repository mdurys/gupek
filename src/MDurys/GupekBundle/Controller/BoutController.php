<?php

namespace MDurys\GupekBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MDurys\GupekBundle\Entity\Bout;
use MDurys\GupekBundle\Entity\Meeting;
use MDurys\GupekBundle\Form\BoutType;

/**
 * Bout controller.
 *
 * @Route("/bout")
 */
class BoutController extends Controller
{
    /**
     * Creates a new Bout entity.
     *
     * @Route("/{meeting}", name="bout_create")
     * @Method("POST")
     */
    public function createAction(Request $request, Meeting $meeting)
    {
        $bout = new Bout();
        $bout->setMeeting($meeting);
        $form = $this->createCreateForm($bout);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bout);
            $em->flush();

            return $this->redirect($this->generateUrl('mdurys_gupek_meeting_show', ['id' => $meeting->getId()]));
        }

        return $this->render('MDurysGupekBundle:Bout:new.html.twig', [
            'bout' => $bout,
            'form' => $form->createView()
            ]);
    }

    /**
     * Creates a form to create a Bout entity.
     *
     * @param Bout $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Bout $bout)
    {
        $form = $this->createForm(new BoutType(), $bout, [
            'action' => $this->generateUrl('bout_create', ['meeting' => $bout->getMeeting()->getId()]),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'form.button.create']);

        return $form;
    }

    /**
     * Displays a form to create a new Bout entity.
     *
     * @Route("/new/{meeting}", name="bout_new")
     * @Method("GET")
     */
    public function newAction(Meeting $meeting)
    {
        $bout = new Bout();
        $bout->setMeeting($meeting);
        $form  = $this->createCreateForm($bout);

        return $this->render('MDurysGupekBundle:Bout:new.html.twig', [
            'bout' => $bout,
            'form' => $form->createView()
            ]);
    }

    /**
     * Finds and displays a Bout entity.
     *
     * @Route("/{id}", name="bout_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MDurysGupekBundle:Bout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bout entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Bout entity.
     *
     * @Route("/{id}/edit", name="bout_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MDurysGupekBundle:Bout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bout entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
    * Creates a form to edit a Bout entity.
    *
    * @param Bout $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bout $entity)
    {
        $form = $this->createForm(new BoutType(), $entity, [
            'action' => $this->generateUrl('bout_update', ['id' => $entity->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }

    /**
     * Edits an existing Bout entity.
     *
     * @Route("/{id}", name="bout_update")
     * @Method("PUT")
     * @Template("MDurysGupekBundle:Bout:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MDurysGupekBundle:Bout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bout entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bout_edit', ['id' => $id]));
        }

        return [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Bout entity.
     *
     * @Route("/{id}", name="bout_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MDurysGupekBundle:Bout')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bout entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bout'));
    }

    /**
     * Creates a form to delete a Bout entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bout_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => 'form.button.delete'])
            ->getForm()
        ;
    }
}
