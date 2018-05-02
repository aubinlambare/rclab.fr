<?php

namespace RCLAB\WebsiteBundle\Controller;

use RCLAB\WebsiteBundle\Entity\Demande;
use RCLAB\WebsiteBundle\Form\DemandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CoursController extends Controller
{
    public function coursAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page !');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('@RCLABWebsite/Cours/cours.html.twig');
    }


    public function demandeAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();

        $matieres = $em->getRepository('RCLABWebsiteBundle:Matiere')->findMatiere();
        $niveaux = $em->getRepository('RCLABWebsiteBundle:Niveau')->findNiveau();

        $demande = new Demande();

        $form = $this->createForm(DemandeType::class, $demande, array(
            'matieres' => $matieres,
            'niveaux' => $niveaux,
            'etat' => 'demande'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $demande->setDemandeur($user);

            $demande->setTdemande();

            $em->persist($demande);
            $em->flush();

            $this->addFlash('success', 'La demande a bien été enregistrée');

            return $this->redirectToRoute('rclab_website_cours_cours');
        }

        return $this->render('@RCLABWebsite/Demande/cours_demande.html.twig', array(
            'form' => $form,
        ));
    }


    public function validerAction()
    {

    }
}