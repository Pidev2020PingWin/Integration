<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Formation;
use AdminBundle\Form\FormationType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;


class FormationBackController extends Controller
{

    public function ajoutFormationAction(Request $request)
    {

        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        ///Pour recuperer les entrees de la form comme post dans le
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           // $formation->setIdm($this->getUser());
            $formation->setNom($request->get('nom'));
            $sdt = $request->get('date');
            $dt = DateTime::createFromFormat("Y-m-d", $sdt);
            //On recupere l'EntityManager
            $em = $this->getDoctrine()->getManager();
//            $dt=date('Y-m-d',$request->get('date'));
            $formation->setDate($dt);
            $formation->uploadProfilePicture();
            $nb=$formation->getNbrplace();
            $nb=$nb-1;
            $formation->setNbrplace($nb);

            //On persiste l'entite
            $em->persist($formation);
            ///for the execution
            //On flush ce qui a ete persiste avant
            $em->flush();
//            dump($form->getErrors(true));
//            die();
            ///for showing redirection
            return $this->redirectToRoute("show_Formation");
        }
        ///
        return $this->render("@Admin/Formation/addFormation.html.twig", array(
            'form' => $form->createView()
        ));

    }


    public function showFormationAction()
    {
        $test=0;
        $em=$this->getDoctrine()->getManager();
        $datej=  new \DateTime('now');
        $formations=$em->getRepository("UserBundle:Formation")->findAll();
        return $this->render('@Admin/Formation/showformation.html.twig',array(
            'formations' => $formations,'datej'=>$datej,'test'=>$test
        ));

    }


    public function RemoveFormationAction(Request $request)
    {

        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $formation=$em->getRepository("UserBundle:Formation")->find($id);
        $em->remove($formation);
        $em->flush();
        return $this->redirectToRoute("show_Formation");
    }
    public function updateFormationAction(Request $request){
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $formation=$em->getRepository("UserBundle:Formation")->find($id);
        $img=$formation->getNomImage();
        $nom=$formation->getNom();

        $date=$formation->getDate();
        $fot = $date->format('Y-m-d');
        $form=$this->createForm(FormationType::class,$formation);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $sdt =$request->get('date');
            $dt = DateTime::createFromFormat("Y-m-d", $sdt);
            $formation->setDate($dt);
            $formation->uploadProfilePicture();
            $em->persist($formation);
            $em->flush();
            return $this->redirectToRoute("show_Formation");
        }
        return $this->render("@Admin/Formation/updateFormation.html.twig",array(
            'form'=>$form->createView(),'formation'=>$formation ,"img"=>$img,"nom"=>$nom,"fot"=>$fot));
    }

    //////Statistiques
    public function statAction(){
        $pieChart = new PieChart();
        $em= $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT r  ,UPPER(f.nom) as nom ,COUNT(r.idformation) as num FROM UserBundle:Reservation r 
join UserBundle:Formation f with f.id=r.idformation GROUP BY r.idformation');
        $reservations=$query->getScalarResult();
        $data= array();
        $stat=['idformation', 'idr'];
        $i=0;
        array_push($data,$stat);

        $ln= count($reservations);
        for ($i=0 ;$i<count($reservations);$i++){
            $stat=array();
            array_push($stat,$reservations[$i]['nom'],$reservations[$i]['num']/$ln);
            $stat=[$reservations[$i]['nom'],$reservations[$i]['num']*100/$ln];

            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable( $data );
        $pieChart->getOptions()->setTitle('Pourcentages des réservations par formation');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@Admin\Formation\chartFormation.html.twig', array('piechart' => $pieChart));
    }

    public function showAvisAction()
    {
        $em=$this->getDoctrine()->getManager();
        $avis=$em->getRepository("UserBundle:Reservation")->findAll();
        return $this->render("@Admin/Formation/showAvis.html.twig",array(
            'avis'=>$avis
        ));
    }


    public function mailAction(Request $request){
        $id=$request->get('id');
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository("UserBundle:Reservation")->find($id);


//        if($request->isMethod('POST')){
        $message = \Swift_Message::newInstance()
            ->setSubject($request->get('subj'))
            ->setFrom('huntkingdom.ammar@esprit.tn','Hunt Kingdom')
            ->setTo('tesnime.ammar@esprit.tn')
        ->setBody($request->get('description'));


        $this->get('mailer')->send($message);

//        }


        return $this->render("@Admin/Formation/mailpage.html.twig",array(
            'reservation'=>$reservation
        ));

    }
}
