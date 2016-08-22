<?php
/**
 * Par AETZA.
 * Date: 22/08/2016
 * Heure: 16:20
 */

namespace AE\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

    public function loginAction( Request $request)
    {
        if( $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
            return $this->redirectToRoute('ae_booking_homepage');
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('AEUserBundle:Security:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ));
    }


}