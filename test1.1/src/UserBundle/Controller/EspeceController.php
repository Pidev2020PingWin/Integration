<?php


namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\CategorieEspece;
use UserBundle\Entity\Espece;
use UserBundle\Form\EspeceType;


class EspeceController extends Controller
{
    public function afficherespecebackAction()

    {
        $espece=$this->getDoctrine()->getRepository(Espece::class)->findAll();
        return $this->render('@User/Espece/especeback.html.twig',array("espece"=>$espece) );
    }

    public function ajoutespeceAction(Request $request)
    {

        $espece = new espece();

        $form = $this->createForm(EspeceType::class, $espece);
        $form = $form->handleRequest($request);


        if ($form->isSubmitted()) {
            $espece->uploadProfilePicture();
            $em = $this->getDoctrine()->getManager();
            $em->persist($espece);
            $em->flush();
            return $this->redirectToRoute('afficherespeceback');

        }
        return $this->render('@User/espece/addespece.html.twig', array('form' => $form->createView()));
    }

    public function supprimerespeceAction($id){
        $em=$this->getDoctrine()->getManager();
        $espece=$em->getRepository(Espece::class)->find($id);
        $em->remove($espece);
        $em->flush();
        return $this->redirectToRoute( "afficherespeceback");
    }

    public function modifierespeceAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $p= $em->getRepository('UserBundle:Espece')->find($id);
        $form=$this->createForm(EspeceType::class,$p);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $p->uploadProfilePicture();
            $em= $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush(); //commit càd l'execution
            return $this->redirectToRoute('afficherespeceback');
        }
        return $this->render('@User/Espece/modifierespece.html.twig', array(
            "form"=> $form->createView()
        ));
    }

    public function afficherespecefrontAction($id)

    {
        $cat=$this->getDoctrine()->getRepository(CategorieEspece::class)->find($id);
        $espece=$this->getDoctrine()->getRepository(Espece::class)->findBy(array('categorie'=>$cat));
        return $this->render('@User/Espece/especefront.html.twig',array("espece"=>$espece) );
    }

}