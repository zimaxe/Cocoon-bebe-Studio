<?php

namespace AE\BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AEBookingBundle:Default:index.html.twig');
    }
}
