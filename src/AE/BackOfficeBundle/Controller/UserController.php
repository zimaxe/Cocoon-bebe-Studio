<?php

namespace AE\BackOfficeBundle\Controller;


use AE\BackOfficeBundle\Form\UserAddType;
use AE\BackOfficeBundle\Form\UserEditType;
use AE\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Exception\NotFoundResourceException;


class UserController extends Controller
{

    public function loginAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('ae_backoffice_user_index');
        }
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('AEBackOfficeBundle:User:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ));
    }


    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AEUserBundle:User')->getPhotographers();
        return $this->render('AEBackOfficeBundle:User:index.html.twig', array(
            'users' => $users
        ));
    }

    public function addAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserAddType::class, $user, array('validation_groups' => array('registration')));

        //Handle the submit (only on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $user->setRoles(['ROLE_PHOTOGRAPHER']);

            //Encode the password
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            //dump($user); die();
            //Save the user
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);

            if ($user->getIsActive() == 1) {
                //Augmente les quotas existants de %max_slots%
                $quotas = $this->get('ae_booking.quota.quota_add_photographer');
                $quotas->increaseQuota();
            }


            $em->flush();

            $this->get('session')->getFlashBag()->add("notif", "L'utilisateur a bien été créé");
            return $this->redirectToRoute("ae_backoffice_user_index");
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


        if (null === $user) {
            throw new NotFoundResourceException("notif", "Ce photographe n'existe pas !!!");
        }

        //Create form
        $form = $this->createForm(UserEditType::class, $user, array('validation_groups' => array('edit')));

        //Statut de IsActive avant edition
        $oldIsActive = $user->getIsActive();
        $request->attributes->set('oldIsActive', $oldIsActive);

        //Handle form
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $validator = $this->get('validator');
            $errors = $validator->validate($user);
            if (count($errors) > 0) {
                return new Response((string)$errors);
            } else {

                if ($user->getPlainPassword()) {
                    //Encode the password
                    $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
                    $user->setPassword($password);
                }

                $em->flush();
                $request->getSession()->getFlashBag()->add("notif", "L'utilisateur a bien été éditée !");
                return $this->redirectToRoute("ae_backoffice_user_index", ['id' => $user->getId()]);
            }

        }


        return $this->render('AEBackOfficeBundle:User:edit.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("AEUserBundle:User")->find($id);

        if(null === $user)
        {
            throw new NotFoundResourceException("L'utilisateur n'existe pas !");
        }

        $quotas = $this->get('ae_booking.quota.quota_edit_photographer');
        $quotas->decreaseQuota($user->getId());

        $em->remove($user);
        $em->flush();

        $request->getSession()->getFlashBag()->add("notif", "Le photographe a bien été supprimé !");
        if($user == $this->getUser()){
            $this->get('security.token_storage')->setToken(null);
            $request->getSession()->invalidate();
        }

        return $this->redirectToRoute("ae_backoffice_user_index");
        
    }

}
