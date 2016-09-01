<?php

namespace AE\BookingBundle\Controller;

use AE\BookingBundle\Entity\Customer;
use AE\BookingBundle\Entity\Quota;
use AE\BookingBundle\Form\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class CustomerController extends Controller
{
    public function indexAction(Request $request)
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() )
        {

            $quotas = $this->get('ae_booking.quota.quota_customer');
            $quotas->decrementQuotas($customer->getOrderDate());

            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            $request->getSession()->getFlashBag()->add("notif", "Votre réservation a bien été effectuée !");
            return $this->redirectToRoute("ae_booking_homepage");
        }

        return $this->render('AEBookingBundle:Customer:index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function getSlotsAction(Request $request)
    {
            $em = $this->getDoctrine()->getManager();
            $slots = $em->getRepository("AEBookingBundle:Quota")->getSlots();
            $test = [];
            foreach ($slots as $s){
                $test[] = $s->getQuotaDay()->format('Y-m-d');
            }
            return new JsonResponse($test);

    }



}
