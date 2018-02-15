<?php

namespace Cnccv\HouseBundle\Controller;

use Cnccv\HouseBundle\Entity\Booking;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Booking controller.
 * @Route("reservation")
 */
class BookingController extends Controller
{
    /**
     * Lists all reservation entities.
     *
     * @Route("/reservation", name="reservation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservations = $em->getRepository('CnccvHouseBundle:Booking')->findAll();

        return $this->render('reservation/index.html.twig', array(
            'reservations' => $reservations,
        ));
    }

    /**
     * Creates a new reservation entity.
     *
     * @Route("/reservation/new", name="reservation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reservation = new Booking();
        $form = $this->createForm('Cnccv\HouseBundle\Form\BookingType', $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('reservation_show', array('id' => $reservation->getId()));
        }

        return $this->render('reservation/new.html.twig', array(
            'reservation' => $reservation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservation entity.
     *
     * @Route("/reservation/{id}", name="reservation_show")
     * @Method("GET")
     */
    public function showAction(Booking $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);

        return $this->render('reservation/show.html.twig', array(
            'reservation' => $reservation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reservation entity.
     *
     * @Route("/reservation/edit/{id}", name="reservation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Booking $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);
        $editForm = $this->createForm('Cnccv\HouseBundle\Form\BookingType', $reservation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_edit', array('id' => $reservation->getId()));
        }

        return $this->render('reservation/edit.html.twig', array(
            'reservation' => $reservation,
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
    public function deleteAction(Request $request, Booking $reservation)
    {
        $form = $this->createDeleteForm($reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservation);
            $em->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }

    /**
     * Creates a form to delete a reservation entity.
     *
     * @param Booking $reservation The reservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Booking $reservation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservation_delete', array('id' => $reservation->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * @param $logement_id
     * @param  \DateTime $start_date
     * @param  \DateTime $end_date
     * @return bool
     */
    public function dispoAction($logement_id, $start_date, $end_date)
    {
        $qb = $this->repository->createQueryBuilder('reservation');
        $query = $qb->select('reservation.id')
            ->where('reservation.start_date <= :start_date AND reservation.end_date >= :end_date')
            ->orWhere('reservation.start_date >= :start_date AND reservation.end_date <= :end_date')
            ->orWhere('reservation.start_date >= :start_date AND reservation.end_date >= :end_date AND reservation.start_date <= :end_date')
            ->orWhere('reservation.start_date <= :start_date AND reservation.end_date <= :end_date AND reservation.end_date >= :start_date')
            ->andWhere('reservation.logement_id = :logement_id')
            ->setParameters(array(
                'start_date' => $start_date,
                'end_date' => $end_date,
                'logement_id' => $logement_id
            ));

        $results = $query->getQuery()->getResult();

        return count($results) === 0;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param $join array(field, alias)
     * @param \DateTime $start_date
     * @param \DateTime $end_date
     */
    public function siDispoAction(QueryBuilder $queryBuilder, $join, \DateTime $start_date, \DateTime $end_date)
    {
        $queryBuilder->leftJoin($join['field'], $join['alias'])
            ->where($join['alias'] . '.start_date >= :start_date AND ' . $join['alias'] . '.end_date <= :end_date')
            ->orWhere($join['alias'] . '.start_date <= :start_date AND ' . $join['alias'] . '.end_date >= :end_date')
            ->orWhere($join['alias'] . '.start_date <= :start_date AND ' . $join['alias'] . '.end_date >= :end_date AND ' .
                $join['alias'] . '.start_date <= :end_date')
            ->orWhere($join['alias'] . '.star_datet >= :start_date AND ' . $join['alias'] . '.end_date <= :end_date AND ' .
                $join['alias'] . '.end_date >= :start_date')
            ->setParameters(array(
                'start_date' => $start_date,
                'end_date' => $end_date,
            ));
    }
}
