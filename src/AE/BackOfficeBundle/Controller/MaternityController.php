<?php
/**
 * Par AETZA.
 * Date: 06/09/2016
 * Heure: 16:54
 */

namespace AE\BackOfficeBundle\Controller;


use AE\BackOfficeBundle\Form\MaternityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AE\BookingBundle\Entity\Maternity;
use Symfony\Component\HttpFoundation\Request;

class MaternityController extends Controller
{


    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $maternity = $em->getRepository('AEBookingBundle:Maternity')->findAll();

        return $this->render('AEBackOfficeBundle:Maternity:index.html.twig', array(
            'maternity' => $maternity
        ));
    }


    public function addAction(Request $request)
    {
        $maternity = new Maternity();
        $form = $this->createForm(MaternityType::class, $maternity);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($maternity);
            $em->flush();

            $request->getSession()->getFlashBag()->add("notif", "La maternité a bien été créée !");
            return $this->redirectToRoute("ae_backoffice_maternity_index");

        }

        return $this->render('AEBackOfficeBundle:Maternity:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $maternity = $em->getRepository('AEBookingBundle:Maternity')->find($id);

        if (null === $maternity) {
            throw new NotFoundResourceException("notif", "Cette n'existe pas en base de données !!!");
        }

        $form = $this->createForm(MaternityType::class, $maternity);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add("notif", "La maternité a bien été éditée !");
            return $this->redirectToRoute("ae_backoffice_maternity_index");
        }

        return $this->render('@AEBackOffice/Maternity/edit.html.twig', array(
            'form' => $form->createView(),
            'maternity' => $maternity
        ));


    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $maternity = $em->getRepository("AEBookingBundle:Maternity")->find($id);

        if(null === $maternity) {
            throw new NotFoundResourceException("La maternité n'existe pas en base de données !");
        }

        $em->remove($maternity);
        $em->flush();

        $request->getSession()->getFlashBag()->add("notif", "La maternité a bien été supprimée !");
        return $this->redirectToRoute("ae_backoffice_maternity_index");

    }


}