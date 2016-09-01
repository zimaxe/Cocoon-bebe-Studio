<?php

namespace AE\BackOfficeBundle\Controller;

use AE\BookingBundle\Entity\Holiday;
use AE\BackOfficeBundle\Form\HolidayType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class HolidayController extends Controller
{
    public function indexAction($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $holidays = $em->getRepository("AEBookingBundle:Holiday")->findBy(['user' => $userId]);
        //dump($holidays); die();

        return $this->render('AEBackOfficeBundle:Holiday:index.html.twig', array(
            // ...
        ));
    }

    public function addAction(Request $request)
    {


        $holiday = new Holiday();
        $form = $this->createForm(HolidayType::class, $holiday);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $holiday->setUser($this->getUser());

            $quotas = $this->get('ae_booking.quota.quota_holiday');
            $quotas->decrementQuota($holiday->getDateStart(), $holiday->getDateEnd());

            $em = $this->getDoctrine()->getManager();
            $em->persist($holiday);
            $em->flush();

            $request->getSession()->getFlashBag()->add("notif", "Votre congé a bien été pris en compte !");
            return $this->redirectToRoute("ae_backoffice_holiday_add");

        }

        return $this->render('AEBackOfficeBundle:Holiday:add.html.twig', array(
           'form' => $form->createView()
        ));
    }

    public function editAction($id)
    {
        return $this->render('AEBackOfficeBundle:Holiday:edit.html.twig', array(
            // ...
        ));
    }

    public function deleteAction($id)
    {

        return $this->render('AEBackOfficeBundle:Holiday:delete.html.twig', array(
            // ...
        ));
    }

}
