<?php
/**
 * Created by PhpStorm.
 * User: aubin
 * Date: 19/04/18
 * Time: 23:07
 */

namespace RCLAB\UserBundle\Controller;


use RCLAB\UserBundle\Entity\User;
use RCLAB\UserBundle\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function registerAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            return $this->render('@RCLABUser/User/check_email.html.twig', array( 'user' => $user ));
            /*$em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();*/

            //$request->getSession()->getFlashBag()->add('success', 'L\'utilisateur vient d\'être enregistrée');

            //return $this->redirectToRoute('rclab_website_home');
        }

        return $this->render('@RCLABWebsite/Default/actualite.html.twig', array( 'form' => $form->createView() ));
    }

    public function checkEmailAction()
    {

    }
}