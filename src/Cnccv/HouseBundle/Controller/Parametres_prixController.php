<?php

namespace Cnccv\HouseBundle\Controller;

use Cnccv\HouseBundle\Entity\Parametres_prix;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Parametres_prix controller.
 *
 * @Route("parametres_prix")
 */
class Parametres_prixController extends Controller
{
    /**
     * Lists all parametres_prix entities.
     *
     * @Route("/", name="parametres_prix_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parametres_prixes = $em->getRepository('CnccvHouseBundle:Parametres_prix')->findAll();

        return $this->render('parametres_prix/index.html.twig', array(
            'parametres_prixes' => $parametres_prixes,
        ));
    }

    /**
     * Creates a new parametres_prix entity.
     *
     * @Route("/new", name="parametres_prix_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $parametres_prix = new Parametres_prix();
        $form = $this->createForm('Cnccv\HouseBundle\Form\Parametres_prixType', $parametres_prix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parametres_prix);
            $em->flush();

            return $this->redirectToRoute('parametres_prix_show', array('id' => $parametres_prix->getId()));
        }

        return $this->render('parametres_prix/new.html.twig', array(
            'parametres_prix' => $parametres_prix,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a parametres_prix entity.
     *
     * @Route("/{id}", name="parametres_prix_show")
     * @Method("GET")
     */
    public function showAction(Parametres_prix $parametres_prix)
    {
        $deleteForm = $this->createDeleteForm($parametres_prix);

        return $this->render('parametres_prix/show.html.twig', array(
            'parametres_prix' => $parametres_prix,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing parametres_prix entity.
     *
     * @Route("/{id}/edit", name="parametres_prix_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Parametres_prix $parametres_prix)
    {
        $deleteForm = $this->createDeleteForm($parametres_prix);
        $editForm = $this->createForm('Cnccv\HouseBundle\Form\Parametres_prixType', $parametres_prix);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parametres_prix_edit', array('id' => $parametres_prix->getId()));
        }

        return $this->render('parametres_prix/edit.html.twig', array(
            'parametres_prix' => $parametres_prix,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a parametres_prix entity.
     *
     * @Route("/{id}", name="parametres_prix_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Parametres_prix $parametres_prix)
    {
        $form = $this->createDeleteForm($parametres_prix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parametres_prix);
            $em->flush();
        }

        return $this->redirectToRoute('parametres_prix_index');
    }

    /**
     * Creates a form to delete a parametres_prix entity.
     *
     * @param Parametres_prix $parametres_prix The parametres_prix entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Parametres_prix $parametres_prix)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('parametres_prix_delete', array('id' => $parametres_prix->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
