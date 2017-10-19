<?php

namespace Cnccv\HouseBundle\Controller;

use Cnccv\HouseBundle\Entity\Base_prix;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Base_prix controller.
 *
 * @Route("base_prix")
 */
class Base_prixController extends Controller
{
    /**
     * Lists all base_prix entities.
     *
     * @Route("/", name="base_prix_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $base_prixes = $em->getRepository('CnccvHouseBundle:Base_prix')->findAll();

        return $this->render('base_prix/index.html.twig', array(
            'base_prixes' => $base_prixes,
        ));
    }

    /**
     * Creates a new base_prix entity.
     *
     * @Route("/new", name="base_prix_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $base_prix = new Base_prix();
        $form = $this->createForm('Cnccv\HouseBundle\Form\Base_prixType', $base_prix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($base_prix);
            $em->flush();

            return $this->redirectToRoute('base_prix_show', array('id' => $base_prix->getId()));
        }

        return $this->render('base_prix/new.html.twig', array(
            'base_prix' => $base_prix,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a base_prix entity.
     *
     * @Route("/{id}", name="base_prix_show")
     * @Method("GET")
     */
    public function showAction(Base_prix $base_prix)
    {
        $deleteForm = $this->createDeleteForm($base_prix);

        return $this->render('base_prix/show.html.twig', array(
            'base_prix' => $base_prix,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing base_prix entity.
     *
     * @Route("/{id}/edit", name="base_prix_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Base_prix $base_prix)
    {
        $deleteForm = $this->createDeleteForm($base_prix);
        $editForm = $this->createForm('Cnccv\HouseBundle\Form\Base_prixType', $base_prix);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('base_prix_edit', array('id' => $base_prix->getId()));
        }

        return $this->render('base_prix/edit.html.twig', array(
            'base_prix' => $base_prix,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a base_prix entity.
     *
     * @Route("/{id}", name="base_prix_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Base_prix $base_prix)
    {
        $form = $this->createDeleteForm($base_prix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($base_prix);
            $em->flush();
        }

        return $this->redirectToRoute('base_prix_index');
    }

    /**
     * Creates a form to delete a base_prix entity.
     *
     * @param Base_prix $base_prix The base_prix entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Base_prix $base_prix)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('base_prix_delete', array('id' => $base_prix->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
