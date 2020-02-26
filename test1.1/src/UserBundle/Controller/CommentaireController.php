<?php

namespace UserBundle\Controller;
use UserBundle\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use UserBundle\Form\CommentaireType;

/**
 * Commentaire controller.
 *
 */
class CommentaireController extends Controller
{




    public function ajouterCommentaireAction(Request $request)

    {

        $Commentaire = new Commentaire();
        $form = $this->createForm('UserBundle\Form\CommentaireType', $Commentaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Commentaire);
            $em->flush();
            return $this->redirectToRoute('commentaire_afficher');
        }
        return $this->render('@User/informations/commentaire/ajouterCommentaire.html.twig', array('Commentaire' => $Commentaire, 'form' => $form->createView()));

    }
    public function deleteCommentaireAction(Request $request,$id)
    {
        //the manager is the responsible for saving objects, deleting and updating object
        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository(Commentaire::class)->find($id);
        //the remove() method notifies Doctrine that you'd like to remove the given object from the database
        $em->remove($commentaire);
        //The flush() method execute the DELETE query.
        $em->flush();
        //redirect our function to the read page to show our table
        return $this->redirectToRoute('commentaire_afficher');

    }
    public function updateCommentaireAction($id, Request $request){

        $todo = $this->getDoctrine()
            ->getRepository('UserBundle:Commentaire')
            ->find($id);


        $form = $this->createForm(Commentaire::class, $todo);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $sn = $this->getDoctrine()->getManager();
            $todo = $sn->getRepository('UserBundle:Commentaire')->find($id);
            $sn->persist($todo);
            $sn->flush();

            return $this->redirectToRoute('commentaire_afficher');
        }

        return $this->render('@User/informations/commentaire/updatecommentaire.html.twig', array(

            'todo'=>$todo,
            'form'=>$form->createView()
        ));

    }


    public function AfficherCommentaireAction()
    {
        $commentaire = $this->getDoctrine()->getRepository('UserBundle:Commentaire')->findAll();
        //add the list of clubs to the render function as input to be sent to the view
        return $this->render('@User/informations/commentaire/afficherCommentaire.html.twig', array('commentaire' => $commentaire));
    } }