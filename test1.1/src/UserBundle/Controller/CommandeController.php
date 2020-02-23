<?php


namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Commande;
use UserBundle\Entity\Produit;
use UserBundle\Form\CommandeType;
use Dompdf\Dompdf;
use Dompdf\Options;


class CommandeController extends Controller
{
    public function ajoutCommandeAction(Request $request,$id)
    {

        $commande = new commande();
        $produit=$this->getDoctrine()->getRepository(Produit::class)->find($id);
        $product=$this->getDoctrine()->getRepository(Produit::class)->findAll();
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $commande->setUser($currentUser);
        $commande->setProduit($produit);

        $form = $this->createForm(CommandeType::class, $commande);
        $form = $form->handleRequest($request);


        if ($form->isSubmitted()) {
            $prixtotal=$produit->getPrix()*$commande->getQuantite();
            $commande->setPrixtotal($prixtotal);
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();
            return $this->redirectToRoute('panier');
        }
        var_dump($commande->getQuantite());
        return $this->render('@User/Produit/produitchasse.html.twig',array('form' => $form->createView(),"produit"=>$product));
    }


    public function page_commandeAction(Request $request,$id){

        $produit=$this->getDoctrine()->getRepository(Produit::class)->findBy(array('id'=>$id));
        $commande = new commande();
        $product=$this->getDoctrine()->getRepository(Produit::class)->find($id);

        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $commande->setUser($currentUser);
        $commande->setProduit($product);

        $form = $this->createForm(CommandeType::class, $commande);
        $form = $form->handleRequest($request);


        if ($form->isSubmitted()) {

            $prixtotal=$product->getPrix()*$commande->getQuantite();
            $commande->setPrixtotal($prixtotal);
            $commande->setEtat('Non Validé');
            $commande->setPay('Non Payée');

            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();
            return $this->redirectToRoute('panier');
        }


        return $this->render('@User/Commande/addcommandechasse.html.twig',array("produit"=>$produit,'form' => $form->createView()));


    }
    public function page_commande2Action(Request $request,$id){

        $produit=$this->getDoctrine()->getRepository(Produit::class)->findBy(array('id'=>$id));
        $commande = new commande();
        $product=$this->getDoctrine()->getRepository(Produit::class)->find($id);

        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $commande->setUser($currentUser);
        $commande->setProduit($product);
        $commande->setEtat('Non Validé');
        $commande->setPay('Non Payée');
        $form = $this->createForm(CommandeType::class, $commande);
        $form = $form->handleRequest($request);


        if ($form->isSubmitted()) {


                $prixtotal = $product->getPrix() * $commande->getQuantite();
                $commande->setPrixtotal($prixtotal);

                $em = $this->getDoctrine()->getManager();

                $em->persist($commande);
                $em->flush();
                return $this->redirectToRoute('panier');
            }





        return $this->render('@User/Commande/addcommandepeche.html.twig',array("produit"=>$produit,'form' => $form->createView()));


    }

    public function afficher_panierAction()
{
    $produit=$this->getDoctrine()->getRepository(Commande::class)->findAll();
    $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
    return $this->render('@User/panier/panier.html.twig',array("commandes"=>$produit,"user"=> $currentUser));
}
    public function afficher_commande_backAction()
    {
        $produit=$this->getDoctrine()->getRepository(Commande::class)->findAll();
        return $this->render('@User/Produit/commandeback.html.twig',array("commandes"=>$produit));
    }

    public function supprimercommandeAction($id){
        $em=$this->getDoctrine()->getManager();
        $com=$em->getRepository(Commande::class)->find($id);
        $em->remove($com);
        $em->flush();
        return $this->redirectToRoute( "panier");
    }

    public function ValiderCommandeAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();

        $p= $em->getRepository('UserBundle:Commande')->find($id);
        $produit=$p->getproduit()->getid();
        $product=$em->getRepository(Produit::class)->find($produit);
        $p->setetat("Validé");
        $product->setQuantite($product->getQuantite() - $p->getQuantite());
            $em= $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->persist($product);
            $em->flush(); //commit càd l'execution


        return $this->redirectToRoute('commande_back');

    }

    public function invalidAction($id){
        $em=$this->getDoctrine()->getManager();
        $com=$em->getRepository(Commande::class)->find($id);
        $em->remove($com);
        $em->flush();
        return $this->redirectToRoute( 'commande_back');
    }

    public function mailAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $com=$em->getRepository(Commande::class)->find($id);
        $user=$com->getuser();
        $mail=$user->getEmail();


        $message = (new \Swift_Message('Confirmation de commande'))
            ->setFrom('mohamedyassine.bennacef@esprit.tn')
            ->setTo($mail)
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    '@User/Mail/mail.html.twig',array('commande'=>$com,'user'=>$user)
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
        return $this->redirectToRoute('commande_back');
    }

    public function PDFAction($id)
    {
        // Configure Dompdf according to your needs
        $commande =  $this->getDoctrine()->getRepository(Commande::class)->findOneBy(array('id'=>$id));
        $user=$commande->getuser();

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('@User/Commande/pdf.html.twig', [
            'title' => "Bon de commande" , 'commande' => $commande,'user'=>$user
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
    public function PDF2Action()
    {
        // Configure Dompdf according to your needs
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $commande =  $this->getDoctrine()->getRepository(Commande::class)->findBy(array('user'=>$currentUser));
        $user=$commande[0]->getuser();
        for($i=0;$i<count($commande);$i++)
        {
            if($commande[$i]->getEtat()=="Validé")
            {
                $val[$i]=$commande[$i];
            }
        }

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('@User/Commande/pdf2.html.twig', [
            'title' => "Bon de commande" , 'commande' => $val,'user'=>$user
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }


}



