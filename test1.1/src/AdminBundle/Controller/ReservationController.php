<?php

namespace AdminBundle\Controller;

use UserBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Formation;
use Symfony\Component\HttpFoundation\Request;
class ReservationController extends Controller
{

    public function ReserverAction(Request $request)
    {
        ////
        $em= $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $idu=$user->getId();

        $id=$request->get('id');

        $Formation=$em->getRepository('UserBundle:Formation')->find($id);
        $reservation=$em->getRepository('UserBundle:Reservation')->findOneBy(array('idu'=>$idu,'idformation'=>$id));
//        $enseignes = $em->getRepository("ClientBundle:Participation")->findAll();

     //   $datej=new \DateTime('now');

      //  $week=date("Y-m-d", strtotime("-1 week"));

      //  $query = $em->createQuery('SELECT f FROM AdminBundle:Formation f WHERE f.date >=:d1 ');
      //  $query->setParameter('d1',$week);
//
       // $formations = $query->getResult();

        if(empty($reservation)){
            $msg='reservation';
            $reservation=new Reservation();
            $reservation->setEtat("interssé");
            $reservation->setAvis("pas encore");
            $reservation-> setIdu($user);
            $reservation-> setIdformation($Formation);
          $nbr= $Formation->getNbrplace();
            $nbr=$nbr-1;
            $Formation->setNbrplace($nbr);
            $em->persist($reservation);
            $em->persist($Formation);
            $em->flush();
            $em=$this->getDoctrine()->getManager();
            $etat="interssé";
            $formations=$em->getRepository(Formation::class);
            return $this->redirectToRoute('formation_list',array('MessageFormation'=>$msg,'formations'=>$formations));
        }

        $msg  =  'Déjà participant! Cliquez pour annuler!';
        $em=$this->getDoctrine()->getManager();
        $reservation->setEtat("non interessé");
        $em->persist($Formation);
        $em->flush();
        $etat="non interssé";
        $formations=$em->getRepository(Formation::class);
        return $this->redirectToRoute('formation_list',array('MessageFormation'=>$msg,'formations'=>$formations));
    }



    public function showMyReservationAction(Request $request){
        $msg1="Cliquez sur Avis pour nous donner votre avis ";
        $msg2="Cliquez sur annuler si vous souhaitez annuler votre réservation ";
        $id=$this->getUser()->getId();
        $etat="interssé";
        $em=$this->getDoctrine()->getManager();
        $query = $em->createQuery(" SELECT f FROM UserBundle:Formation f JOIN UserBundle:Reservation r WITH r.idformation = f.id WHERE r.idu=:id AND r.etat like :etat");

        $query->setParameters(array('id'=>$id,'etat'=>$etat));

        $formations = $query->getResult();

//       $events=$em->getRepository("UserBundle:Evttesting")->findAll();
        $msg="Participer pour nous joindre";
        return $this->render("@User/Reservation/showMyReservation.html.twig",array(
            'formations'=>$formations,'MessageEvent1'=>$msg1,'MessageEvent2'=>$msg2
        ));
    }

    public function AnnulerReservationAction(Request $request)
    {

       // $msg1  =  'Votre participation a été annulée avec succés!';

        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $reservation= new Reservation();
        $reservation=$em->getRepository("UserBundle:Reservation")->findOneByidformation($id);
        $reservation->setEtat("non interssé");
        $em->persist($reservation);
        $em->flush();
        $etat="interssé";

//

        return $this->redirectToRoute("show_MyReservation");
    }



}