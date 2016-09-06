<?php
/**
 * Par AETZA.
 * Date: 06/09/2016
 * Heure: 16:07
 */

namespace AE\BackOfficeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CustomerController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $customers = $em->getRepository('AEBookingBundle:Customer')->findAll();

        return $this->render('AEBackOfficeBundle:Customer:index.html.twig', array(
            'customers' => $customers
        ));

    }

}