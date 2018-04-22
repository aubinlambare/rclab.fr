<?php
/**
 * Created by PhpStorm.
 * User: aubin
 * Date: 17/04/18
 * Time: 21:25
 */

namespace RCLAB\UserBundle\Controller;


use RCLAB\UserBundle\Entity\UserAdmin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function InscriptionAction(Request $request)
    {
        $user = new UserAdmin();

        $form = $this->createForm(NewsType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($obj);
            $em->flush();

            return false;
        }
    }
}