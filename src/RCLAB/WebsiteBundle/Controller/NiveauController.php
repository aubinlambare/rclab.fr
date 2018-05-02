<?php

namespace RCLAB\WebsiteBundle\Controller;

use RCLAB\WebsiteBundle\Entity\Niveau;
use RCLAB\WebsiteBundle\Form\NiveauType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NiveauController extends Controller
{
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    public function niveauxAction()
    {

        $niveaux = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:Niveau')->findAll();

        return $this->render('@RCLABWebsite/Niveau/niveaux.html.twig', array(
            'niveaux' => $niveaux,
        ));
    }

    public function addNiveauAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');

        $niveau = new Niveau();

        $form = $this->createForm(NiveauType::class, $niveau, array(
            'ajout' => true
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file = $niveau->getIcone();
            if (!empty($file)) {

                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $file->move(
                    $this->getParameter('image_directory'),
                    $fileName
                );
                $niveau->setIcone($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($niveau);
            $em->flush();

            $this->addFlash(
                'success', 'Le niveau a bien été ajouté'
            );
            return $this->redirectToRoute('rclab_website_niveau_niveaux');
        }

        return $this
            ->render('@RCLABWebsite/Niveau/add_niveau.html.twig', array(
                'form' => $form->createView(),
            ));
    }

    public function editNiveauAction(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');

        $niveau = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:Niveau')->find($id);

        if (!$niveau) {

            $this->addFlash('error', 'Le niveau n\'a pas pu être modifié');
            return $this->redirectToRoute('rclab_website_niveau_niveaux');
        } else {

            $oldIcone = $niveau->getIcone();
            $niveau->setIcone(null);

            $role = 'moderator';
            if (true === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
                $role = 'admin';
            }

            $form = $this->createForm(NiveauType::class, $niveau, array(
                'role' => $role
            ));

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $file = $niveau->getIcone();
                if (!empty($file)) {

                    $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                    $file->move(
                        $this->getParameter('image_directory'),
                        $fileName
                    );
                    $niveau->setIcone($fileName);
                    $this->get('rclab_website.remove.file')->removeFile($oldIcone);
                } else {

                    $niveau->setIcone($oldIcone);
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($niveau);
                $em->flush();

                $this->addFlash(
                    'success', 'Le niveau a bien été modifié'
                );
                return $this->redirectToRoute('rclab_website_niveau_niveaux');
            }

            return $this->render('@RCLABWebsite/Niveau/edit_niveau.html.twig', array(
                'form' => $form->createView(),
                'niveau' => $niveau,
            ));
        }
    }

    public function historiseNiveauAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');

        $niveau = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:Niveau')->find($id);

        if (!$niveau) {

            $this->addFlash('error', 'Le niveau n\'a pas pu être historisé');
        } else {

            $niveau->setHistorique(true);

            $em = $this->getDoctrine()->getManager();
            $em->persist($niveau);
            $em->flush();

            $this->addFlash(
                'success', 'Le niveau a bien été historisé'
            );
        }
        return $this->redirectToRoute('rclab_website_niveau_niveaux');
    }

    public function unhistoriseNiveauAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');

        $niveau = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:Niveau')->find($id);

        if (!$niveau) {

            $this->addFlash('error', 'Le niveau n\'a pas pu être déhistorisé');
        } else {

            $niveau->setHistorique(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($niveau);
            $em->flush();

            $this->addFlash(
                'success', 'Le niveau a bien été déhistorisé'
            );
        }
        return $this->redirectToRoute('rclab_website_niveau_niveaux');
    }

    public function removeNiveauAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();
        $niveau = $em->getRepository('RCLABWebsiteBundle:Niveau')->find($id);

        if (!$niveau) {

            $this->addFlash('error', 'Le niveau n\'a pas pu être supprimé');
        } else {

            $this->get('rclab_website.remove.file')->removeFile($niveau->getIcone());
            $em->remove($niveau);
            $em->flush();

            $this->addFlash(
                'success', 'Le niveau a bien été supprimé'
            );
        }
        return $this->redirectToRoute('rclab_website_niveau_niveaux');
    }
}