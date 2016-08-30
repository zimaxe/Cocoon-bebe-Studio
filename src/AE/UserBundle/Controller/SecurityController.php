<?php
/**
 * Par AETZA.
 * Date: 22/08/2016
 * Heure: 16:20
 */

namespace AE\UserBundle\Controller;


use AE\UserBundle\Entity\User;
use AE\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SecurityController
 * @package AE\UserBundle\Controller
 */
class SecurityController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
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


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        //Build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        //Handle the submit (only on POST)
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            //Encode the password
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            //Role
            $user->setRoles(['ROLE_USER']);

            //Save the User
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add("notif", "Votre compte a bien été créé");
            return $this->redirectToRoute("ae_booking_homepage");

        }

        return $this->render('AEUserBundle:Security:register.html.twig', array(
            'form' => $form->createView()
        ));
    }


}