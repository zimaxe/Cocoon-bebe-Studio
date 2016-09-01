<?php

namespace AE\BackOfficeBundle\Controller;

use AE\BackOfficeBundle\Form\UserAddType;
use AE\BackOfficeBundle\Form\UserEditType;
use AE\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller
{

    public function loginAction(Request $request)
    {

        if( $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
            return $this->redirectToRoute('ae_booking_homepage');
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('AEBackOfficeBundle:User:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ));
    }


    public function customersAction()
    {
        return $this->render('AEBackOfficeBundle:User:customers.html.twig', array(
            // ...
        ));
    }

    public function adminsAction()
    {
        return $this->render('AEBackOfficeBundle:User:admins.html.twig', array(
            // ...
        ));
    }

    public function addAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserAddType::class, $user);

        //Handle the submit (only on POST)
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            //Encode the password
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            //Save the user
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add("notif", "L'utilisateur a bien été créé");
            return $this->redirectToRoute("ae_backoffice_admins");
        }


        return $this->render('AEBackOfficeBundle:User:add.html.twig', array(
            'form' => $form->createView()
        ));

    }

    public function editAction($id, Request $request)
    {
        //Find User
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AEUserBundle:User')->find($id);


        //Create form
        $form = $this->createForm(UserEditType::class, $user);

        //Value of plainPassword
        $plainFirst = $request->request->all()['user_edit']['plainPassword']['first'];
        $plainSecond = $request->request->all()['user_edit']['plainPassword']['second'];

        $isNewPassword = ( $plainFirst == "" )? false : true;

        if( !$isNewPassword ){
            $oldPassword = $user->getPassword();
            $request->request->set($plainFirst, $oldPassword );
            $request->request->set($plainSecond, $oldPassword );

            dump($request->request); die();
        }else{
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
        }

        //Handle form
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            if($form->isValid()){
                $em->flush();
                $request->getSession()->getFlashBag()->add("notif", "L'utilisateur a bien été éditée !");
                return $this->redirectToRoute("ae_backoffice_admins", ['id' => $user->getId()]);
            }



        }


        return $this->render('AEBackOfficeBundle:User:edit.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    public function deleteAction()
    {
        return $this->render('AEBackOfficeBundle:User:delete.html.twig', array(
            // ...
        ));
    }

}
