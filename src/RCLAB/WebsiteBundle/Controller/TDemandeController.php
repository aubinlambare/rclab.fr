<?php

namespace RCLAB\WebsiteBundle\Controller;

use RCLAB\WebsiteBundle\Entity\T_Demande;
use RCLAB\WebsiteBundle\Form\T_DemandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TDemandeController extends Controller
{
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    public function tDemandeAction()
    {

        $niveaux = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:T_Demande')->findAll();

        return $this->render('@RCLABWebsite/TDemande/tdemande.html.twig', array(
            'tdemandes' => $niveaux,
        ));
    }

    public function addTDemandeAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $tdemande = new T_Demande();

        $form = $this->createForm(T_DemandeType::class, $tdemande);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file = $tdemande->getIcone();
            if (!empty($file)) {

                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $file->move(
                    $this->getParameter('image_directory'),
                    $fileName
                );
                $tdemande->setIcone($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($tdemande);
            $em->flush();

            $this->addFlash(
                'success', 'Le type de demande a bien été ajouté'
            );
            return $this->redirectToRoute('rclab_website_tdemandes');
        }

        return $this
            ->render('@RCLABWebsite/TDemande/add_tdemande.html.twig', array(
                'form' => $form->createView(),
            ));
    }

    public function editTDemandeAction(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $tdemande = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:T_Demande')->find($id);

        if(!$tdemande) {

            $this->addFlash('error', 'Le type de demande n\'a pas pu être modifié');
            return $this->redirectToRoute('rclab_website_tdemandes');
        } else {

            $oldIcone = $tdemande->getIcone();
            $tdemande->setIcone(null);

            $role = 'admin';
            if (true === $this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                $role = 'super_admin';
            }


            $form = $this->createForm(T_DemandeType::class, $tdemande, array(
                'role' => $role
            ));

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {

                $file = $tdemande->getIcone();
                if (!empty($file)) {

                    $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                    $file->move(
                        $this->getParameter('image_directory'),
                        $fileName
                    );
                    $tdemande->setIcone($fileName);
                } else {

                    $tdemande->setIcone($oldIcone);
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($tdemande);
                $em->flush();

                $this->addFlash(
                    'success', 'Le type de demande a bien été modifié'
                );
                return $this->redirectToRoute('rclab_website_tdemandes');
            }

            return $this->render('@RCLABWebsite/TDemande/edit_tdemande.html.twig', array(
                'form' => $form->createView(),
                'tdemande' => $tdemande,
            ));
        }
    }

    public function historiseTDemandeAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $tdemande = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:T_Demande')->find($id);

        if(!$tdemande) {

            $this->addFlash('error', 'Le type de demande n\'a pas pu être historisé');
        } else {

            $tdemande->setHistorique(true);

            $em = $this->getDoctrine()->getManager();
            $em->persist($tdemande);
            $em->flush();

            $this->addFlash(
                'success', 'Le type de demande a bien été historisé'
            );
        }
        return $this->redirectToRoute('rclab_website_tdemandes');
    }

    public function unhistoriseTDemandeAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $tdemande = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:T_Demande')->find($id);

        if(!$tdemande) {

            $this->addFlash('error', 'Le type de demande n\'a pas pu être déhistorisé');
        } else {

            $tdemande->setHistorique(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($tdemande);
            $em->flush();

            $this->addFlash(
                'success', 'Le type de demande a bien été déhistorisé'
            );
        }
        return $this->redirectToRoute('rclab_website_tdemandes');
    }

    public function removeTDemandeAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();
        $tdemande = $em->getRepository('RCLABWebsiteBundle:T_Demande')->find($id);

        if(!$tdemande) {

            $this->addFlash('error', 'Le type de demande n\'a pas pu être supprimé');
        } else {

            $this->get('rclab_website.remove.file')->removeFile($tdemande->getIcone());
            $em->remove($tdemande);
            $em->flush();

            $this->addFlash(
                'success', 'Le type de demande a bien été supprimé'
            );
        }
        return $this->redirectToRoute('rclab_website_tdemandes');
    }
}