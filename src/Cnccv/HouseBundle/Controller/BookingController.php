<?php

namespace Cnccv\HouseBundle\Controller;

use Cnccv\HouseBundle\Entity\Booking;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Booking controller.
 *
 * @Route("reservation")
 */
class BookingController extends Controller
{
    /**
     * Lists all booking entities.
     *
     * @Route("/reservation", name="reservation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bookings = $em->getRepository('CnccvHouseBundle:Booking')->findAll();

        return $this->render('reservation/index.html.twig', array(
            'bookings' => $bookings,
        ));
    }

    /**
     * Creates a new booking entity.
     *
     * @Route("/reservation/new", name="reservation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $booking = new Booking();
        $form = $this->createForm('Cnccv\HouseBundle\Form\BookingType', $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            return $this->redirectToRoute('reservation_show', array('id' => $booking->getId()));
        }

        return $this->render('reservation/new.html.twig', array(
            'booking' => $booking,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservation entity.
     *
     * @Route("/reservation/{id}", name="reservation_show")
     * @Method("GET")
     */
    public function showAction(Booking $booking)
    {
        $deleteForm = $this->createDeleteForm($booking);

        return $this->render('reservation/show.html.twig', array(
            'booking' => $booking,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reservation entity.
     *
     * @Route("/reservation/edit/{id}", name="reservation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Booking $booking)
    {
        $deleteForm = $this->createDeleteForm($booking);
        $editForm = $this->createForm('Cnccv\HouseBundle\Form\BookingType', $booking);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_edit', array('id' => $booking->getId()));
        }

        return $this->render('reservation/edit.html.twig', array(
            'booking' => $booking,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservation entity.
     *
     * @Route("/reservation/delete/{id}", name="reservation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Booking $booking)
    {
        $form = $this->createDeleteForm($booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($booking);
            $em->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }

    /**
     * Creates a form to delete a reservation entity.
     *
     * @param Booking $booking The reservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Booking $booking)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservation_delete', array('id' => $booking->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
