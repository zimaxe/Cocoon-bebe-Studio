<?php

namespace AE\BookingBundle\Controller;

use AE\BookingBundle\Entity\Customer;
use AE\BookingBundle\Form\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CustomerController extends Controller
{
    public function indexAction()
    {
        //dump($this->container->getParameter('max_slot')); die();

        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);

        //var_dump($test); die();
        $test = [ '2016-09-17', '2016-09-12', '2016-09-16' ];
        $test =  new JsonResponse($test);

        return $this->render('AEBookingBundle:Customer:index.html.twig', [
            'form' => $form->createView(),
            'test' => $test
        ]);
    }

    public function getSlotsAction(Request $request)
    {
        $test = [ '2016-09-17', '2016-09-12', '2016-09-16' ];
        return new JsonResponse($test);
    }



}
