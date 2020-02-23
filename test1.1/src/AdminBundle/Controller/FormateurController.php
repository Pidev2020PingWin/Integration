<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Formateur;
use AdminBundle\Form\FormateurType;
use Symfony\Component\HttpFoundation\Request;
class FormateurController extends Controller
{

    public function ajoutFormateurAction(Request $request)
    {

        $formateur = new Formateur();
        $form = $this->createForm(FormateurType::class, $formateur);
        ///Pour recuperer les entrees de la form comme post dans le
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            //On recupere l'EntityManager
            $em = $this->getDoctrine()->getManager();
            $formateur->uploadProfilePicture();
            //On persiste l'entite
            $em->persist($formateur);
            ///for the execution
            //On flush ce qui a ete persiste avant
            $em->flush();
//            dump($form->getErrors(true));
//            die();
            ///for showing redirection
            return $this->redirectToRoute("show_Formateur");
        }
        ///
        return $this->render("@Admin/Formateur/addFormateur.html.twig", array(
            'form' => $form->createView()
        ));

    }


    public function showFormateurAction()
    {
        //create our entity manager: get the service doctrine
        $em = $this->getDoctrine();
        //repository help you fetch (read) entities of a certain class.
        $repository = $em->getRepository(Formateur::class);
        //find *all* 'Projet' objects
        $formateurs = $repository->findAll();
        //render a template with the list of objects
        return $this->render('@Admin/Formateur/showformateur.html.twig', array(
            'formateurs' => $formateurs
        ));
    }


    public function RemoveFormateurAction(Request $request)
    {

        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $formateur=$em->getRepository("UserBundle:Formateur")->find($id);
        $em->remove($formateur);
        $em->flush();
        return $this->redirectToRoute("show_Formateur");
    }
    public function updateFormateurAction(Request $request){
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $formateur=$em->getRepository("UserBundle:Formateur")->find($id);
        $img=$formateur->getNomImage();
        $nom=$formateur->getNom();


        $form=$this->createForm(FormateurType::class,$formateur);
        $form->handleRequest($request);
        if($form->isSubmitted()){

            $formateur->uploadProfilePicture();
            $em->persist($formateur);
            $em->flush();
            return $this->redirectToRoute("show_Formateur");
        }
        return $this->render("@Admin/Formateur/updateFormateur.html.twig",array(
            'form'=>$form->createView(),'formateur'=>$formateur ,"img"=>$img,"nom"=>$nom));
    }

}
