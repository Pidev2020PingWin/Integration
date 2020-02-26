<?php

namespace UserBundle\Controller;

use UserBundle\Entity\Articles_especes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Commentaire;
use UserBundle\Entity\Nblike;
use UserBundle\Form\Articles_especesType;

/**
 * Articles_espece controller.
 *
 */
class Articles_especesController extends Controller
{
    public function ajoutAction(Request $request)

    {

        $Articles_especes = new Articles_especes();
        $form = $this->createForm('UserBundle\Form\Articles_especesType', $Articles_especes);
        $form->handleRequest($request);
        $contenu = $form['contenu']->getData();
        $chain = $contenu;
        $mot = "bleu";
        $mot1 = "rouge";
        $mot2 = "vert";
        if ( strpos ($chain, $mot)){
            $chain=  str_replace($mot, "*****", $chain);
            $contenu = $chain;
        }
        if ( strpos ($chain, $mot1)){
            $chain= str_replace($mot1, "*****", $chain);
            $contenu = $chain;
        }
        if ( strpos ($chain, $mot2)){
            $chain= str_replace($mot2, "*****", $chain);
            $contenu = $chain;
        }
        //$datecreation = new\DateTime('now');
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $Articles_especes->setIdEspeces(0);
            $Articles_especes->setIdCat(0);
            $Articles_especes->setIdArticle(0);
            $Articles_especes->setNumlike(0);
            $em->persist($Articles_especes);
            $em->flush();




            return $this->redirectToRoute('articles_afficher');
        }
        return $this->render('@User/informations/Articles_especes/ajoutarticle.html.twig', array('Articles_especes' => $Articles_especes, 'form' => $form->createView()));

}

    public function deleteAction(Request $request,$id)
    {
        //the manager is the responsible for saving objects, deleting and updating object
        $em = $this->getDoctrine()->getManager();
        $Articles_especes = $em->getRepository(Articles_especes::class)->find($id);
        //the remove() method notifies Doctrine that you'd like to remove the given object from the database
        $em->remove($Articles_especes);
        //The flush() method execute the DELETE query.
        $em->flush();
        //redirect our function to the read page to show our table
        return $this->redirectToRoute('articles_afficher');

    }

    public function AfficherAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();


        $Articles_especes = $em->getRepository('UserBundle:Articles_especes')->findBy([], ['datepub' => 'DESC']);

        ///////////// Pagination
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $Articles_especes, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );

        return $this->render('@User/informations/Articles_especes/articles.html.twig',array('Articles_especes'=>$pagination));


    }



    public function AffichernewAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();


        $Articles_especes = $em->getRepository('UserBundle:Articles_especes')->findBytitre('new');
        ///////////// Pagination
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $Articles_especes, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );
        return $this->render('@User/informations/Articles_especes/newarticle.html.twig',array('Articles_especes'=>$pagination));
    }

    public function detailAction()
    {
        $Articles_especes = $this->getDoctrine()->getRepository(Articles_especes::class)->findAll();
        //add the list of clubs to the render function as input to be sent to the view
        return $this->render('@User/informations/Articles_especes/question_reponse.html.twig', array('Articles_especes' => $Articles_especes));
    }

    public function updateAction($id, Request $request){

        $todo = $this->getDoctrine()
            ->getRepository('UserBundle:Articles_especes')
            ->find($id);

        $todo->setTitre($todo->getTitre());
        $todo->setContenu($todo->getContenu());


        $form = $this->createForm(Articles_especesType::class, $todo);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $sn = $this->getDoctrine()->getManager();
            $todo = $sn->getRepository('UserBundle:Articles_especes')->find($id);
            $sn->persist($todo);
            $sn->flush();

            return $this->redirectToRoute('articles_afficher');
        }

        return $this->render('@User/informations/Articles_especes/updatearticless.html.twig', array(

            'todo'=>$todo,
            'form'=>$form->createView()
        ));}

        public function showAction(Request $request, Articles_especes $article)

        {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $post = $em->getRepository('UserBundle:Articles_especes')->find($article);

            $arr = array();

            if ($request->isMethod('post')) {

                $comment = new Commentaire();
                $comment->setUser($user);
                $comment->setArticle($article);
                $comment->setContenu($request->get('comment-content'));
                $comment->setDatePub(new \DateTime('now'));
                $em->persist($post);
                $em->persist($comment);
                $em->flush();
                return $this->redirectToRoute('articles_afficher', array('id' => $article->getId()));
            }
            $comments = $em->getRepository('UserBundle:Commentaire')->findBy( array('article' => $article ));
            $numlike = $em->getRepository('UserBundle:Nblike')->findBy( array('article' => $article ));
            $numlikes = count($numlike);
            $numberofcomments = count($comments);
            return $this->render('@User/informations/Articles_especes/question_reponse.html.twig', array(
                'a'=> $article,
                'comments' => $comments,
                'arr' => $arr,
                'numlikes'=>$numlikes,
                'numberofcomments' => $numberofcomments,

            ));
        }



    public function deletecomAction($id)
    {
        //the manager is the responsible for saving objects, deleting and updating object
        $em = $this->getDoctrine()->getManager();
        $Commentaire = $em->getRepository(Commentaire::class)->find($id);
        //the remove() method notifies Doctrine that you'd like to remove the given object from the database
        $em->remove($Commentaire);
        //The flush() method execute the DELETE query.
        $em->flush();
        //redirect our function to the read page to show our table
        return $this->redirectToRoute('articles_afficher');

    }


    public function likearticleAction($id)
    {

        $user = $this->getUser();
        if ($user == null) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('UserBundle:Articles_especes')->find($id);

        $love = new Nblike();

        $love->setUser($user);
        $post->setNumlike($post->getNumlike() + 1);
        $love->setArticle($post);
        $em->persist($love);
        $em->flush();

        return $this->redirectToRoute('articles_afficher');
    }


}