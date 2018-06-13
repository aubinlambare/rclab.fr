<?php
/**
 * Created by PhpStorm.
 * User: aubin
 * Date: 01/05/18
 * Time: 17:36
 */

namespace RCLAB\WebsiteBundle\Controller;


use RCLAB\WebsiteBundle\Entity\Fonction;
use RCLAB\WebsiteBundle\Form\FonctionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FonctionController extends Controller
{
    public function fonctionsAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $functions = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:Fonction')->findAll();

        return $this->render('@RCLABWebsite/Fonction/fonctions.html.twig', array(
            'functions' => $functions,
        ));
    }

    public function addAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $function = new Fonction();

        $form = $this->createForm(FonctionType::class, $function);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($function);
            $em->flush();

            $this->addFlash(
                'success', 'La fonction a bien été ajoutée'
            );
            return $this->redirectToRoute('rclab_website_fonction_list');
        }

        return $this->render('@RCLABWebsite/Fonction/add_fonction.html.twig', array(
            'form' => $form->createView()
    ));
    }

    public function editAction(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();
        $function = $em->getRepository('RCLABWebsiteBundle:Fonction')->find($id);

        if (!$function) {

            $this->addFlash('error', 'La fonction n\'a pas pu être modifiée');
            return $this->redirectToRoute('rclab_website_fonction_list');

        }

        $form = $this->createForm(FonctionType::class, $function, array(
            'function' => $function
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($function);
            $em->flush();

            $this->addFlash(
                'success', 'La fonction a bien été modifiée'
            );
            return $this->redirectToRoute('rclab_website_fonction_list');
        }

        return $this->render('@RCLABWebsite/Fonction/edit_fonction.html.twig', array(
            'form' => $form->createView(),
        ));
        
    }

    public function removeAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();
        $function = $em->getRepository('RCLABWebsiteBundle:Fonction')->find($id);

        if (!$function) {

            $this->addFlash('error', 'La fonction n\'a pas pu être supprimée');
        } else {

            $user = $em->getRepository('RCLABUserBundle:User')->findOneBy(array(
                'fonction' => $id
            ));

            if($user != null) {

                $this->addFlash('error', 'Au moins un utilisateur possède cette fonction');
                return $this->redirectToRoute('rclab_website_fonction_list');
            }

            $em->remove($function);
            $em->flush();

            $this->addFlash(
                'success', 'La fonction a bien été supprimé'
            );
        }
        return $this->redirectToRoute('rclab_website_fonction_list');
    }

}