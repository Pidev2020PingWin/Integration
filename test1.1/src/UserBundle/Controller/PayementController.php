<?php


namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Payum\Core\Request\GetHumanStatus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Entity\Commande;
use UserBundle\Entity\User;

class PayementController extends Controller
{
    public function prepareAction($id)
    {
        $gatewayName = 'offline';

        $storage = $this->get('payum')->getStorage('UserBundle\Entity\Payment');
        $em=$this->getDoctrine()->getManager();
        $com=$em->getRepository(Commande::class)->find($id);
        $user=$em->getRepository(User::class)->findOneBy(array('id'=>$com->getuser()->getid()));
        $u=$user;
        $com->setpay("Payée");


        $payment = $storage->create();
        $payment->setNumber(uniqid());
        $payment->setCurrencyCode('TND');
        $payment->setTotalAmount($com->getPrixtotal());
        $payment->setDescription('Paiement effectué avec succés');
        $payment->setClientId($u->getid());
        $payment->setClientEmail($u->getEmail());

        $storage->update($payment);



        return $this->redirectToRoute('panier');
    }



    public function doneAction(Request $request)
    {
        $token = $this->get('payum')->getHttpRequestVerifier()->verify($request);

        $gateway = $this->get('payum')->getGateway($token->getGatewayName());

        // You can invalidate the token, so that the URL cannot be requested any more:
        // $this->get('payum')->getHttpRequestVerifier()->invalidate($token);

        // Once you have the token, you can get the payment entity from the storage directly.
        // $identity = $token->getDetails();
        // $payment = $this->get('payum')->getStorage($identity->getClass())->find($identity);

        // Or Payum can fetch the entity for you while executing a request (preferred).
        $gateway->execute($status = new GetHumanStatus($token));
        $payment = $status->getFirstModel();

        // Now you have order and payment status

        return new JsonResponse(array(
            'status' => $status->getValue(),
            'payment' => array(
                'total_amount' => $payment->getTotalAmount(),
                'currency_code' => $payment->getCurrencyCode(),
                'details' => $payment->getDetails(),
            ),
        ));
    }
    public function faitAction()
    {
        return $this->render('@User/Commande/paiement.html.twig');

    }
}