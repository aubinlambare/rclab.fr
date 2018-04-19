<?php

namespace RCLAB\WebsiteBundle\Controller;

use RCLAB\WebsiteBundle\Entity\Event;
use RCLAB\WebsiteBundle\Entity\News;
use RCLAB\WebsiteBundle\Form\NewsType;
use RCLAB\WebsiteBundle\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
    
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

    /**
     * @param $request
     * @param $type
     * @return bool|\Symfony\Component\Form\FormView
     */
    public function AddForm($request, $type)
    {
        if ($type == 'News') {
            $obj = new News();
            $form = $this->createForm(NewsType::class, $obj);

        } else{
            $obj = new Event();
            $form = $this->createForm(EventType::class, $obj);
        }


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $obj->getImage();
            if(!empty($file)){
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('image_directory'),
                    $fileName
                );
                $obj->setImage($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($obj);
            $em->flush();

            return false;
        }

        return $form->createView();

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

    /**
     * @param Request $request
     * @return Response
     */
    public function actualiteAction(Request $request)
    {

        $formView = $this->AddForm($request, 'Event');

        if ($formView) {
            return $this
                ->render('@RCLABWebsite/Default/actualite.html.twig', array(
                    'form' => $formView
                ));
        } else {
            return new Response('Event ajouté !');
        }
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
