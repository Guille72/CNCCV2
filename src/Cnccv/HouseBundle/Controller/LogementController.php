<?php

namespace Cnccv\HouseBundle\Controller;

use Cnccv\HouseBundle\Entity\Logement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Logement controller.
 *
 * @Route("logement")
 */
class LogementController extends Controller
{
    /**
     * Lists all logement entities.
     *
     * @Route("/logement", name="logement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $logements = $em->getRepository('CnccvHouseBundle:Logement')->findAll();

        return $this->render('logement/index.html.twig', array(
            'logements' => $logements,
        ));
    }

    /**
     * Creates a new logement entity.
     *
     * @Route("/logement/new", name="logement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $logement = new Logement();
        $form = $this->createForm('Cnccv\HouseBundle\Form\LogementType', $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($logement);
            $em->flush();

            return $this->redirectToRoute('logement_show', array('id' => $logement->getId()));
        }

        return $this->render('logement/new.html.twig', array(
            'logement' => $logement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a logement entity.
     *
     * @Route("/logement/{id}", name="logement_show")
     * @Method("GET")
     */
    public function showAction(Logement $logement)
    {
        $deleteForm = $this->createDeleteForm($logement);

        return $this->render('logement/show.html.twig', array(
            'logement' => $logement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing logement entity.
     *
     * @Route("/logement/edit/{id}", name="logement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Logement $logement)
    {
        $deleteForm = $this->createDeleteForm($logement);
        $editForm = $this->createForm('Cnccv\HouseBundle\Form\LogementType', $logement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('logement_edit', array('id' => $logement->getId()));
        }

        return $this->render('logement/edit.html.twig', array(
            'logement' => $logement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a logement entity.
     *
     * @Route("/logement/delete/{id}", name="logement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Logement $logement)
    {
        $form = $this->createDeleteForm($logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($logement);
            $em->flush();
        }

        return $this->redirectToRoute('logement_index');
    }

    /**
     * Creates a form to delete a logement entity.
     *
     * @param logement $logement The logement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Logement $logement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('logement_delete', array('id' => $logement->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
