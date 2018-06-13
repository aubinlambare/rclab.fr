<?php

namespace RCLAB\WebsiteBundle\Controller;


use RCLAB\WebsiteBundle\Entity\Matiere;
use RCLAB\WebsiteBundle\Form\MatiereType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class MatiereController extends Controller
{
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    public function matieresAction()
    {

        $matieres = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:Matiere')->findAll();

        return $this->render('@RCLABWebsite/Matiere/matieres.html.twig', array(
            'matieres' => $matieres,
        ));
    }

    public function addMatiereAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');

        $matiere = new Matiere();

        $form = $this->createForm(MatiereType::class, $matiere, array(
            'ajout' => true
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file = $matiere->getIcone();
            if (!empty($file)) {

                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $file->move(
                    $this->getParameter('image_directory'),
                    $fileName
                );
                $matiere->setIcone($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();

            $this->addFlash(
                'success', 'La matière a bien été ajoutée'
            );
            return $this->redirectToRoute('rclab_website_matiere_matieres');
        }

        return $this
            ->render('@RCLABWebsite/Matiere/add_matiere.html.twig', array(
                'form' => $form->createView(),
            ));
    }

    public function editMatiereAction(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');

        $matiere = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:Matiere')->find($id);

        if (!$matiere) {

            $this->addFlash('error', 'La matière n\'a pas pu être modifiée');
            return $this->redirectToRoute('rclab_website_matiere_matieres');
        } else {

            $oldIcone = $matiere->getIcone();
            $matiere->setIcone(null);

            $role = 'moderator';
            if (true === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
                $role = 'admin';
            }

            $form = $this->createForm(MatiereType::class, $matiere, array(
                'role' => $role
            ));

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $file = $matiere->getIcone();
                if (!empty($file)) {

                    $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                    $file->move(
                        $this->getParameter('image_directory'),
                        $fileName
                    );
                    $matiere->setIcone($fileName);
                    $this->get('rclab_website.remove.file')->removeFile($oldIcone);
                } else {

                    $matiere->setIcone($oldIcone);
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($matiere);
                $em->flush();

                $this->addFlash(
                    'success', 'La matière a bien été modifiée'
                );
                return $this->redirectToRoute('rclab_website_matiere_matieres');
            }

            return $this->render('@RCLABWebsite/Matiere/edit_matiere.html.twig', array(
                'form' => $form->createView(),
                'matiere' => $matiere,
            ));
        }
    }

    public function historiseMatiereAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');

        $matiere = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:Matiere')->find($id);

        if (!$matiere) {

            $this->addFlash('error', 'La matière n\'a pas pu être historisée');
        } else {

            $matiere->setHistorique(true);

            $em = $this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();

            $this->addFlash(
                'success', 'La matière a bien été historisée'
            );
        }
        return $this->redirectToRoute('rclab_website_matiere_matieres');
    }

    public function unhistoriseMatiereAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');

        $matiere = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:Matiere')->find($id);

        if (!$matiere) {

            $this->addFlash('error', 'La matière n\'a pas pu être déhistorisée');
        } else {

            $matiere->setHistorique(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();

            $this->addFlash(
                'success', 'La matière a bien été déhistorisée'
            );
        }
        return $this->redirectToRoute('rclab_website_matiere_matieres');
    }

    public function removeMatiereAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();
        $matiere = $em->getRepository('RCLABWebsiteBundle:Matiere')->find($id);

        if (!$matiere) {

            $this->addFlash('error', 'La matière n\'a pas pu être supprimée');
        } else {

            $this->get('rclab_website.remove.file')->removeFile($matiere->getIcone());
            $em->remove($matiere);
            $em->flush();

            $this->addFlash(
                'success', 'La matière a bien été supprimée'
            );
        }
        return $this->redirectToRoute('rclab_website_matiere_matieres');
    }
}