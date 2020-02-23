<?php
/**
 * Created by PhpStorm.
 * User: med
 * Date: 04/04/2019
 * Time: 00:37
 */

namespace AdminBundle\Controller;



use Swift_Mailer;
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Notification;
use UserBundle\Entity\Rating;


class EvenementController extends Controller
{
    public function listAction(){
        $em=$this->getDoctrine()->getManager();
        $demandes=$em->getRepository("UserBundle:Demande")->findBy([], ['etat' => 'ASC']);
        return $this->render("@Admin/Evenement/listDemandes.html.twig",array(
            'demande'=>$demandes
        ));
    }
    public function accepterAction(Request $request,$id){
        $em=$this->getDoctrine()->getManager();
        $demande=$em->getRepository("UserBundle:Demande")->find($id);
        $demande->setEtat("valider");
        $em->persist($demande);
        $em->flush();
        // methode rapide pour creer des notifications
        $notif = new Notification();
        $notif->setIdu($em->getRepository("UserBundle:User")->find($demande->getIdu()));
        $notif
            ->setTitle('demande de participation accepter')
            ->setDescription($this->getUser())
            ->setRoute('user_homepage')
            ->setParameters(array('ida'=> $id ));
        $em->persist($notif);
        $em->flush();

        $pusher = $this->get('mrad.pusher.notificaitons');
        $pusher->trigger($notif);
        $transport = Swift_SmtpTransport::newInstance('smtp.googlemail.com',465, 'ssl')
            ->setUsername('anass.merai@esprit.tn')
            ->setPassword('z56hpdpm');

        $mailer = Swift_Mailer::newInstance($transport);


        $message = (new \Swift_Message('Confirmation'))
            ->setFrom('anass.merai@esprit.tn')
            ->setTo($demande->getIdu()->getEmail())
            ->setBody('Votre demande est validée !');
        $mailer->send($message);
        $this->get('mailer')->send($message);
        return $this->redirectToRoute("demande_list");

    }

    public function refuserAction(Request $request,$id){
        $em=$this->getDoctrine()->getManager();
        $demande=$em->getRepository("UserBundle:Demande")->find($id);
        $demande->setEtat("refuser");
        $em->persist($demande);
        $em->flush();
        // methode rapide pour creer des notifications
        $notif = new Notification();
        $notif->setIdu($em->getRepository("UserBundle:User")->find($demande->getIdu()));
        $notif
            ->setTitle('demande de participation refuser')
            ->setDescription($this->getUser())
            ->setRoute('user_homepage')
            ->setParameters(array('ida'=> $id ));
        $em->persist($notif);
        $em->flush();

        $pusher = $this->get('mrad.pusher.notificaitons');
        $pusher->trigger($notif);

        $transport = Swift_SmtpTransport::newInstance('smtp.googlemail.com',465, 'ssl')
            ->setUsername('anass.merai@esprit.tn')
            ->setPassword('z56hpdpm');

        $mailer = Swift_Mailer::newInstance($transport);


        $message = (new \Swift_Message('Confirmation'))
            ->setFrom('anass.merai@esprit.tn')
            ->setTo($demande->getIdu()->getEmail())
            ->setBody('Votre demande a été refusée !');
        $mailer->send($message);
        $this->get('mailer')->send($message);
        return $this->redirectToRoute("demande_list");

    }
    public function listRAction(){
        $em=$this->getDoctrine()->getManager();
        $demandes=$em->getRepository("UserBundle:Rating")->findBy([], ['ide' => 'ASC']);
        return $this->render("@Admin/Evenement/listRatings.html.twig",array(
            'demande'=>$demandes
        ));
    }
    public function mailAction(Request $request){
        $id=$request->get('id');
        $em = $this->getDoctrine()->getManager();
        $rate = $em->getRepository("UserBundle:Rating")->find($id);
        $message = \Swift_Message::newInstance()
            ->setSubject($request->get('subj'))
            ->setFrom('anass.merai@esprit.tn','A propos de votre Rating :')
            ->setTo($rate->getIdu()->getEmail())
        ->setBody($request->get('desc'));
        $this->get('mailer')->send($message);
        return $this->render("@Admin/mail/mail.html.twig",array(
            'rate'=>$rate));

    }


}