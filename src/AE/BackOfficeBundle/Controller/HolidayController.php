<?php

namespace AE\BackOfficeBundle\Controller;

use AE\BackOfficeBundle\Form\HolidayType;
use AE\BookingBundle\Entity\Holiday;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Exception\NotFoundResourceException;


/**
 * Class HolidayController
 * @package AE\BackOfficeBundle\Controller
 */
class HolidayController extends Controller
{
    /**
     * @param $userId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $holidays = $em->getRepository("AEBookingBundle:Holiday")->findBy(['user' => $userId]);

        return $this->render('AEBackOfficeBundle:Holiday:index.html.twig', array(
            'holidays' => $holidays
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $holiday = new Holiday();
        $form = $this->createForm(HolidayType::class, $holiday);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $holiday->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($holiday);

            $quotas = $this->get('ae_booking.quota.quota_holiday');
            $quotas->decrementQuota($holiday->getDateStart(), $holiday->getDateEnd());

            $em->flush();

            $request->getSession()->getFlashBag()->add("notif", "Votre congé a bien été pris en compte !");
            return $this->redirectToRoute("ae_backoffice_holiday_index", array('userId' => $holiday->getUser()->getId()));

        }

        return $this->render('AEBackOfficeBundle:Holiday:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id)
    {
        return $this->render('AEBackOfficeBundle:Holiday:edit.html.twig', array(// ...
        ));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $holiday = $em->getRepository('AEBookingBundle:Holiday')->findOneBy(['id' => $id]);

        if (null === $holiday) {
            throw new NotFoundResourceException("La période de congé n'existe pas !!!");
        }

        $this->get('ae_booking.quota.quota_holiday_delete')->increaseSlots($holiday->getDateStart(), $holiday->getDateEnd());
        $em->remove($holiday);
        $em->flush();

        $request->getSession()->getFlashBag()->add("notif", "Votre congé a bien été supprimé !");
        return $this->redirectToRoute("ae_backoffice_holiday_index", array('userId' => $holiday->getUser()->getId()));
    }

}
