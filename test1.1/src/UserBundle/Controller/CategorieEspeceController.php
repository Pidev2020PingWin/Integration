<?php


namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\CategorieEspece;
use UserBundle\Form\CategorieEspeceType;


class CategorieEspeceController extends Controller
{
    public function afficher_categorieAction(){
        $categorie=$this->getDoctrine()->getRepository(categorieEspece::class)->findAll();
        return $this->render('@User/CategorieEspece/affichercategorie.html.twig',array("categorie"=>$categorie));
    }

    public function ajoutCategorieAction(Request $request)
    {
        $categorie = new categorieEspece();
        $form = $this->createForm(CategorieEspeceType::class, $categorie);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $categorie->uploadProfilePicture();
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('categorieespece');

        }
        return $this->render('@User/CategorieEspece/addcategorieEspese.html.twig', array('form' => $form->createView()));
    }

    public function supprimercategorieAction($id){
        $em=$this->getDoctrine()->getManager();
        $categorie=$em->getRepository(categorieEspece::class)->find($id);
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute( "categorieespece");
    }

    public function modifiercategorieAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $p= $em->getRepository('UserBundle:CategorieEspece')->find($id);
        $form=$this->createForm(CategorieEspeceType::class,$p);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $p->uploadProfilePicture();
            $em= $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush(); //commit càd l'execution
            return $this->redirectToRoute('categorieespece');
        }
        return $this->render('@User/CategorieEspece/modifiercategorieespece.html.twig', array(
            "form"=> $form->createView()
        ));
    }
    public function afficher_categoriefrontAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository("UserBundle:CategorieEspece")->findAll();
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $categorie,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',2)
        );
        $result->setTemplate('@User/Paginator/pagination.html.twig');

        return $this->render('@User/CategorieEspece/affichercategoriefront.html.twig',array("categorie"=>$categorie,'pg'=>$result));
    }

}