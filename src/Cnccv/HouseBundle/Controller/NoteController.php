<?php

namespace Cnccv\HouseBundle\Controller;

use Cnccv\HouseBundle\Entity\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Note controller.
 *
 * @Route("note")
 */
class NoteController extends Controller
{
    /**
     * Lists all note entities.
     *
     * @Route("/note", name="note_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $notes = $em->getRepository('CnccvHouseBundle:Note')->findAll();

        return $this->render('note/index.html.twig', array(
            'notes' => $notes,
        ));
    }

    /**
     * Creates a new note entity.
     *
     * @Route("/note/new", name="note_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $note = new Note();
        $form = $this->createForm('Cnccv\HouseBundle\Form\NoteType', $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

            return $this->redirectToRoute('note_show', array('id' => $note->getId()));
        }

        return $this->render('note/new.html.twig', array(
            'note' => $note,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a note entity.
     *
     * @Route("/note/{id}", name="note_show")
     * @Method("GET")
     */
    public function showAction(Note $note)
    {
        $deleteForm = $this->createDeleteForm($note);

        return $this->render('note/show.html.twig', array(
            'note' => $note,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing note entity.
     *
     * @Route("/note/edit/{id}", name="note_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Note $note)
    {
        $deleteForm = $this->createDeleteForm($note);
        $editForm = $this->createForm('Cnccv\HouseBundle\Form\NoteType', $note);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('note_edit', array('id' => $note->getId()));
        }

        return $this->render('note/edit.html.twig', array(
            'note' => $note,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a note entity.
     *
     * @Route("/note/delete/{id}", name="note_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Note $note)
    {
        $form = $this->createDeleteForm($note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($note);
            $em->flush();
        }

        return $this->redirectToRoute('note_index');
    }

    /**
     * Creates a form to delete a note entity.
     *
     * @param note $note The note entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Note $note)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('note_delete', array('id' => $note->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
