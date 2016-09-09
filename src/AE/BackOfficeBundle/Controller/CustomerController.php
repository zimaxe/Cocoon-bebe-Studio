<?php
/**
 * Par AETZA.
 * Date: 06/09/2016
 * Heure: 16:07
 */

namespace AE\BackOfficeBundle\Controller;


use AE\BookingBundle\Form\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CustomerController extends Controller
{
    public function calendarAction(){
        return $this->render("AEBackOfficeBundle:Customer:calendar.html.twig");
    }

    public function ajaxCalendarEventsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $slots = $em->getRepository("AEBookingBundle:Customer")->findAll();

        $test = [];
        foreach ($slots as $k=>$s){
             $test[] = array(
                'title' => ucfirst($s->getName()).' ('.$s->getMaternity()->getName().')',
                'start' => $s->getOrderDate()->format('Y-m-d 13:30:00'),
                'end' => $s->getOrderDate()->format('Y-m-d 18:30:00'),
                'url' => $this->generateUrl("ae_backoffice_customer_view", array( 'id' => $s->getId() ), true)
            );
        }

        //dump($test); die();

        return new JsonResponse($test);
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $customers = $em->getRepository('AEBookingBundle:Customer')->findAll();

        return $this->render('AEBackOfficeBundle:Customer:index.html.twig', array(
            'customers' => $customers
        ));

    }


    public function dateAction($date){

        $em = $this->getDoctrine()->getManager();
        $date = new \DateTime($date);
        $customers = $em->getRepository('AEBookingBundle:Customer')->findBy(['orderDate' => $date ]);

        return $this->render('AEBackOfficeBundle:Customer:date.html.twig', array(
            'customers' => $customers,
            'date' => $date

        ));
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $customer = $em->getRepository('AEBookingBundle:Customer')->find($id);

        if(null === $customer) {
            throw new NotFoundResourceException("La réservation n'existe pas en base de données !");
        }

        return $this->render('@AEBackOffice/Customer/view.html.twig',array(
            'customer' => $customer
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $customer = $em->getRepository('AEBookingBundle:Customer')->find($id);

        $oldDateOrder = $customer->getOrderDate();

        if(null === $customer) {
            throw new NotFoundResourceException("La réservation n'existe pas en base de données !");
        }

        $form = $this->createForm(CustomerType::class, $customer);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            if($oldDateOrder != $customer->getOrderDate() ){
                if($oldDateOrder >= new \DateTime('00:00:00')){
                    $this->get('ae_booking.quota.quota_edit_customer')->incrementQuotas($oldDateOrder);
                }
                if($customer->getOrderDate() >= new \DateTime('00:00:00')){
                    $this->get('ae_booking.quota.quota_customer')->decrementQuotas($customer->getOrderDate());
                }

            }

            $em->flush();

            $request->getSession()->getFlashBag()->add("notif", "La réservation a bien été éditée !");
            return $this->redirectToRoute("ae_backoffice_customer_index");

        }

        return $this->render('@AEBackOffice/Customer/edit.html.twig',array(
            'form' => $form->createView(),
            'customer' => $customer
        ));
    }

    public function deleteAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $customer = $em->getRepository("AEBookingBundle:Customer")->find($id);

        if(null === $customer) {
            throw new NotFoundResourceException("La réservation n'existe pas en base de données !");
        }

        if($customer->getOrderDate() >= new \DateTime('00:00:00')){
            $this->get('ae_booking.quota.quota_edit_customer')->incrementQuotas($customer->getOrderDate());
        }

        $em->remove($customer);
        $em->flush();

        $request->getSession()->getFlashBag()->add("notif", "La réservation a bien été supprimée !");
        return $this->redirectToRoute("ae_backoffice_customer_index");

    }

}