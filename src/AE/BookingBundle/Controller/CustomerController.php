<?php

namespace AE\BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        dump($this->container->getParameter('max_slot')); die();
        return $this->render('AEBookingBundle:Default:index.html.twig');
    }
}
