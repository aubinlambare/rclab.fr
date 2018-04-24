<?php

namespace RCLAB\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function InfoAsso()
    {
        return $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('RCLABWebsiteBundle:Association')
            ->findOneBy(array());
    }

    public function FindPersonFonctionByTri($tri)
    {
        return $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('RCLABWebsiteBundle:Personne')
            ->findPersonneFonctionByTri($tri);
    }

    public function indexAction()
    {
        return $this->render('@RCLABWebsite/Default/index.html.twig');
    }

    public function associationAction()
    {

        $descriptionAssociation = $this->InfoAsso()->getDescription();

        $personnes = $this->FindPersonFonctionByTri(4);

        return $this->render('@RCLABWebsite/Default/association.html.twig', array('descriptionAssociation' => $descriptionAssociation,
            'personnes' => $personnes));
    }

    public function contactAction()
    {
        $infoAssociation = $this->InfoAsso();


        $personnes = $this->FindPersonFonctionByTri(2);

        return $this->render('@RCLABWebsite/Default/contact.html.twig', array('infoAssociation' => $infoAssociation,
            'personnes' => $personnes));
    }

    public function reparationAction()
    {
        return $this->render('@RCLABWebsite/Default/reparation.html.twig');
    }

    public function coursAction()
    {
        return $this->render('@RCLABWebsite/Default/cours.html.twig');
    }

    public function compteAction()
    {

        return $this->render('@RCLABWebsite/Default/compte.html.twig');
    }
}
