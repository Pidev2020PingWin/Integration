<?php


namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Commande;
use UserBundle\Entity\Produit;
use UserBundle\Entity\Ratingp;
use UserBundle\Form\CommandeType;
use UserBundle\Form\ProduitType;

class ProduitController extends Controller
{
    public function HomeAction()

    {
        $produit=$this->getDoctrine()->getRepository(Produit::class)->findAll();
        $commande=new Commande();
        $form = $this->createForm(CommandeType::class, $commande);

        return $this->render('@User/Produit/produitchasse.html.twig',array("produit"=>$produit, 'form'=> $form->createView()) );
    }
    public function Home2Action()
    {
        $produit=$this->getDoctrine()->getRepository(Produit::class)->findAll();
        $ratings=$this->getDoctrine()->getRepository(Ratingp::class)->findBy(array('produit'=>$produit));



        return $this->render('@User/Produit/produitpeche.html.twig',array("produit"=>$produit) );
    }



    public function afficher_produitAction(){
        $produit=$this->getDoctrine()->getRepository(Produit::class)->findAll();

        return $this->render('@User/produit/afficherproduit.html.twig',array("produit"=>$produit));


    }

    public function ajoutproduitAction(Request $request)
    {

        $produit = new produit();
        $produit->setRating(0);
        $produit->setnbrrating(0);
        $produit->setsommerating(0);
        $form = $this->createForm(ProduitType::class, $produit);
        $form = $form->handleRequest($request);


        if ($form->isSubmitted()) {
            $produit->uploadProfilePicture();
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('aff_prod');

        }
        return $this->render('@User/produit/addproduit.html.twig', array('form' => $form->createView()));
    }


    public function supprimerproduitAction($id){
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository(produit::class)->find($id);
        $em->remove($produit);
        $em->flush();
        return $this->redirectToRoute( "aff_prod");
    }


    public function modifierproduitAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $p= $em->getRepository('UserBundle:Produit')->find($id);
        $form=$this->createForm(produitType::class,$p);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $p->uploadProfilePicture();
            $em= $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush(); //commit càd l'execution
            return $this->redirectToRoute('aff_prod');
        }
        return $this->render('@User/produit/modifierproduit.html.twig', array(
            "form"=> $form->createView()
        ));
    }

    public function calculratingAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $p= $em->getRepository('UserBundle:Produit')->find($id);
        $form=$this->createForm(produitType::class,$p);
        $form->handleRequest($request);


            $em= $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush(); //commit càd l'execution
            return $this->redirectToRoute('aff_prod');
        }






}