<?php


namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Ratingp;
use UserBundle\Entity\Produit;
use UserBundle\Form\RatingpType;

class RatingpController extends Controller
{
    public function afficher_ratingAction(){
        $rating=$this->getDoctrine()->getRepository(Ratingp::class)->findAll();

        return $this->render('@User/Ratingp/afficherrating.html.twig',array("rating"=>$rating));
    }

    public function rating_chasseAction(Request $request,$id){

        $produit=$this->getDoctrine()->getRepository(Produit::class)->findBy(array('id'=>$id));
        $rating = new Ratingp();
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $prod=$produit[0];
        $rate=$this->getDoctrine()->getRepository(Ratingp::class)->findOneBy(array('produit'=>$prod,'user'=>$currentUser));

$somme=0;
$moyenne=0.0;

        $rating->setUser($currentUser);
        $rating->setProduit($prod);


        $form = $this->createForm(RatingpType::class, $rating);
        $form = $form->handleRequest($request);


        if ($form->isSubmitted()) {
            $prod->setnbrrating($prod->getnbrrating()+1);

            if ($rating->getdegre() == "Très Satisfait")

            {
                $somme = $somme+100;
            }
            if ($rating->getdegre() == "Satisfait") {
                $somme += 75;
            }

            if ($rating->getdegre() == "Passable") {
                $somme += 50;
            }
            if ($rating->getdegre() == "InSatisfait") {
                $somme += 25;
            }
            if ($rating->getdegre() == "Trés InSatisfait") {
                $somme += 0;
            }

            $moyenne = $somme/(100*$rating->getProduit()->getnbrrating());
            $prod->setrating($moyenne);
            $em = $this->getDoctrine()->getManager();
            $em->persist($prod);
            $em->persist($rating);
            $em->flush();
            return $this->redirectToRoute('produit');
        }


        return $this->render('@User/Ratingp/addratingchasse.html.twig',array("produit"=>$produit,'form' => $form->createView(),"rate"=>$rate));


    } public function rating_pecheAction(Request $request,$id){
    $rating = new Ratingp();
    $produit=$this->getDoctrine()->getRepository(Produit::class)->findBy(array('id'=>$id));
    $prod=$produit[0];
    $somme=0;
    $moyenne=0.0;

        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $rate=$this->getDoctrine()->getRepository(Ratingp::class)->findOneBy(array('produit'=>$prod,'user'=>$currentUser));
        $rating->setUser($currentUser);
        $rating->setProduit($prod);

        $form = $this->createForm(RatingpType::class, $rating);
        $form = $form->handleRequest($request);


    if ($form->isSubmitted()) {

        $prod->setnbrrating($prod->getnbrrating()+1);

        if ($rating->getdegre() == "Très Satisfait")

        {
            $somme = $prod->getsommerating()+100;
        }
        if ($rating->getdegre() == "Satisfait") {
            $somme = $prod->getsommerating()+75;
        }

        if ($rating->getdegre() == "Passable") {
            $somme = $prod->getsommerating()+50;
        }
        if ($rating->getdegre() == "Insatisfait") {
            $somme = $prod->getsommerating()+25;
        }
        if ($rating->getdegre() == "Très InSatisfait") {
            $somme = $prod->getsommerating()+0;
        }
        $prod->setsommerating($somme);
        $moyenne = $prod->getsommerating()/(100*$prod->getnbrrating());

        $prod->setrating($moyenne);
        $em = $this->getDoctrine()->getManager();
        $em->persist($prod);
        $em->persist($rating);
        $em->flush();
        return $this->redirectToRoute('peche');
        }


        return $this->render('@User/Ratingp/addratingpeche.html.twig',array("produit"=>$produit,'form' => $form->createView(),"rate"=>$rate));


    }

}
