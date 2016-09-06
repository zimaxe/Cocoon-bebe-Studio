<?php
/**
 * Par AETZA.
 * Date: 06/09/2016
 * Heure: 16:54
 */

namespace AE\BackOfficeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AE\BookingBundle\Entity\Maternity;

class MaternityController extends Controller
{


    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $maternity = $em->getRepository('AEBookingBundle:Maternity')->findAll();

        return $this->render('AEBackOfficeBundle:Maternity:index.html.twig', array(
            'maternity' => $maternity
        ));
    }


}