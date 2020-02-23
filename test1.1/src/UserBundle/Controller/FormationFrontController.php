<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Cadeau;
use UserBundle\Entity\Formation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class FormationFrontController extends Controller
{

    public function listFormationAction()
    {
        $user = $this->getUser();
        $idu = $user->getId();
        $em = $this->getDoctrine();
        $repository = $em->getRepository(Formation::class);
        $formations = $repository->findAll();
        $msg = array();

        return $this->render('@User/Formation/listformation.html.twig', array(
            'formations' => $formations, 'MessageFormation' => $msg
        ));
    }

    public function detailFormationAction(Request $request, $id)
    {
        $user = $this->getUser();
        $idu = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository("UserBundle:Formation")->findBy(array('id' => $id));

        //  $msg = array();
        // $rate = array();





        return $this->render("@User/Formation/detailsFormations.html.twig", array( // nbadlou l test twig b list_association.html.twig
            'formation' => $formation
        ));
    }

    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $posts = $em->getRepository('UserBundle:Formation')->findEntitiesByString($requestString);
        if (!$posts) {
            $result['posts']['error'] = "Formation Not found :( ";
        } else {
            $result['posts'] = $this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }

    public function getRealEntities($posts)
    {
        foreach ($posts as $posts) {
            $realEntities[$posts->getId()] = [$posts->getNomImage(), $posts->getNom()];
        }
        return $realEntities;
    }

    ////Donner Avis
    public function AvisFormationAction(Request $request)
    {
        ////
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $idu = $user->getId();

        $id = $request->get('id');

        $Formation = $em->getRepository('UserBundle:Formation')->find($id);
        $reservation = $em->getRepository('UserBundle:Reservation')->findOneBy(array('idu' => $idu, 'idformation' => $id));
//        $enseignes = $em->getRepository("ClientBundle:Participation")->findAll();

        $datej = new \DateTime('now');

        $week = date("Y-m-d", strtotime("-1 week"));

        $query = $em->createQuery(
            'SELECT f
    FROM UserBundle:Formation f
    WHERE f.date >=:d1 '
        );
        $query->setParameter('d1', $week);

        $formations = $query->getResult();

        if ($request->isMethod("post")) {
            $etat = $reservation->getEtat();
            $msg = 'reservation';
            $reservation->setAvis($request->get('avis'));
            $reservation->setIdu($user);
            $reservation->setEtat($etat);
            $reservation->setIdformation($Formation);
            $em->persist($reservation);
            $em->persist($Formation);
            $em->flush();
            $em = $this->getDoctrine()->getManager();
            $formations = $em->getRepository(Formation::class)->findAll();
            return $this->redirectToRoute('show_MyReservation', array('MessageFormation' => $msg, 'formations' => $formations));
        }

        $msg = 'Déjà participant! Cliquez pour annuler!';

        return $this->render('@User/Formation/avisFormation.html.twig', array('MessageFormation' => $msg, 'formations' => $formations));


    }


////Consulter mes points cadeaux
    public function PointsCadeauxAction(Request $request){
        $msg1="";
        $msg2="";
        $result=0;
        $id=$this->getUser()->getId();
        $etat="interssé";
        $criteria=$request->get('search');
        $em=$this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT f FROM UserBundle:Formation f JOIN UserBundle:Reservation r WITH r.idformation = f.id WHERE r.idu=:id AND r.etat like :etat");

        $query->setParameters(array('id'=>$id,'etat'=>$etat));

        $formations = $query->getResult();

        $nbparti=count($formations);
        if ($nbparti<=1){$msg1="Vous n'êtes pas assez actif! Participez de plus avec nous";}
        else if($nbparti>=2 ){$msg2="Vous êtes proche de ganger avec nous! Participez davantage";}
        if ($nbparti>=3) {
            if($request->isMethod('POST')) {
                $codes=$em->getRepository(Cadeau::class)->findBy(array('codecadeau' => $criteria));
                $result=count($codes);
                if ( $result !=0){
                    $reservation = $em->getRepository("UserBundle:Reservation")->findBy(array('idu' => $id));
                    foreach ($reservation as $pa) {
                        $pa->setEtat("valider");
                        $em->persist($pa);
                        $em->flush();
                        $msg2="Bravo! Vous êtes un membre fidèle, vous avez participer à plusieurs formations ,Cliquez pour obtenir ton cadeau";
                    }

                }
                else $msg2="votre code est erronné!Veuillez entrer un code valide";
            }
        }
        return $this->render("@User/Formation/cadeauxReservation.html.twig",array(
            'formations'=>$formations,'MessageFormation1'=>$msg1,'MessageFormation2'=>$msg2,'MessageFormation'=>$nbparti,'Result'=>$result
        ));
    }
    ////Consulter Code
    public function CodeCadeauAction(){
        $id=$this->getUser()->getId();
        $nom=$this->getUser()->getNom();
        return $this->render("@User/Formation/CodeCadeau.html.twig",array('iduser'=>$id,'nomuser'=>$nom

        ));

    }

    ///Save as html

    public function PdfCadeauAction( Request $request){
        $snappy = $this->get('knp_snappy.pdf');
        $msg='Votre QR code cadeau offert par Hunt Kingdom';
        $em = $this->getDoctrine()->getManager();
//      $date= new Date();
//        $dt = DateTime::createFromFormat("Y-m-d", new Date());
        $time = new \DateTime();
        // $time->format('H:i:s \O\n Y-m-d');
        //     $dt = DateTime::createFromFormat("H:i:s \O\n Y-m-d", $time);
//        $date->format('Y-m-d H:i:s');
        ////////
//        $idcmd = $request->get('idCmd');
        $user = $this->getUser();
        $idu = $user->getId();
        $user = $em->getRepository("UserBundle:User")->find($idu);
        $query=$em->createQuery("select r from UserBundle:Reservation r join UserBundle:Formation f with f.id=r.idformation where r.idu=:id ");
        $query->setParameters(array('id'=>$idu ));

        $gagnant= $query->getResult();
        //////////

        $html = $this->renderView('@User/Formation/imprimeCode.html.twig', array("gagnant" => $user, "Message" => $msg
            //..Send some data to your view if you need to //
        ));

        $filename = 'CodeCadeau';
        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );

    }
}