<?php
/**
 * Created by PhpStorm.
 * User: aubin
 * Date: 01/05/18
 * Time: 12:32
 */

namespace RCLAB\WebsiteBundle\Controller;


use RCLAB\WebsiteBundle\Entity\Association;
use RCLAB\WebsiteBundle\Form\AssociationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AssociationController extends Controller
{
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    public function associationAction()
    {

        $em = $this->getDoctrine()->getManager();

        $descriptionAssociation = $em->getRepository('RCLABWebsiteBundle:Association')->findOneBy(array())->getDescription();


        $users = $em->getRepository('RCLABUserBundle:User')->findUserFonctionByTri(6);

        return $this->render('@RCLABWebsite/Association/association.html.twig', array(
            'descriptionAssociation' => $descriptionAssociation,
            'personnes' => $users,
            'logo_asso' => $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:Association')->findOneBy(array())->getLogoAsso()
        ));
    }

    public function editAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();

        $association = $em->getRepository('RCLABWebsiteBundle:Association')->findOneBy(array());

        if($association == null) {

            $association = new Association();
        }

        $oldImage = $association->getImageFocus();
        $association->setImageFocus(null);

        $oldLogo = $association->getLogoAsso();
        $association->setLogoAsso(null);

        $form = $this->createForm(AssociationType::class, $association);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $file = $association->getImageFocus();
            if (!empty($file)) {

                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $file->move(
                    $this->getParameter('image_directory'),
                    $fileName
                );
                $association->setImageFocus($fileName);
            } else {

                $association->setImageFocus($oldImage);
            }

            $file = $association->getLogoAsso();
            if (!empty($file)) {

                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $file->move(
                    $this->getParameter('image_directory'),
                    $fileName
                );
                $association->setLogoAsso($fileName);
            } else {

                $association->setLogoAsso($oldLogo);
            }


            $em = $this->getDoctrine()->getManager();
            $em->persist($association);
            $em->flush();

            $this->addFlash(
                'success', 'Les informations ont bien été modifiées'
            );
            return $this->redirectToRoute('rclab_website_association_edit');
        }

        return $this->render('@RCLABWebsite/Association/edit_association.html.twig', array(
           'form' => $form->createView(),
            'image_focus' => $oldImage,
            'logo' => $oldLogo,
            'logo_asso' => $oldLogo
        ));
    }
}