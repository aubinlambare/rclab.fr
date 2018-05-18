<?php
/**
 * Created by PhpStorm.
 * User: aubin
 * Date: 06/05/18
 * Time: 11:27
 */

namespace RCLAB\WebsiteBundle\Controller;


use RCLAB\WebsiteBundle\Entity\Demande;
use RCLAB\WebsiteBundle\Form\EditRepairType;
use RCLAB\WebsiteBundle\Form\RequestRepairType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RepairController extends Controller
{
    public function repairsAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page');

        $repository = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $my_repairs = $repository->findMyRepairsNotHistory($user);

        return $this->render('@RCLABWebsite/Demand/Repair/repair.html.twig', [
            'my_repairs' => $my_repairs,
        ]);
    }

    public function requestAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page');

        $repair = new Demande();

        $form = $this->createForm(RequestRepairType::class, $repair);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $repair->setDemandeur($user);

            $tdemande = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:T_Demande')->findOneBy(array('typeDemande' => 'réparation'));
            $repair->setTdemande($tdemande);

            $repair->setEtat('demande');

            $em = $this->getDoctrine()->getManager();
            $em->persist($repair);
            $em->flush();

            $this->addFlash('success', 'Votre demande a bien été prise en compte');
            return $this->redirectToRoute('rclab_website_repair');
        }

        return $this->render('@RCLABWebsite/Demand/Repair/request_repair.html.twig', array(
           'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request, $id)
    {
        $repair = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande')->find($id);

        if(!$repair) {

            $this->addFlash('warning', 'Impossible de gérer cette réparation');
            return $this->redirectToRoute('rclab_website_repair');
        }

        $form = $this->createForm(EditRepairType::class, $repair, [
            'etat' => $repair->getEtat(),
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($repair);
            $em->flush();

            $this->addFlash('success', 'La modification a été prise en compte');

            return $this->redirect($request->getSession()->get('referer'));
        } else {

            $request->getSession()->set('referer', $request->headers->get('referer'));
        }

        return $this->render('RCLABWebsiteBundle:Demand/Repair:edit_repair.html.twig', [
            'form' => $form->createView(),
            'repair' => $repair,
        ]);
    }

    public function handleAction($page)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page');

        $offset = $page == 1 ? null : ($page - 1) * 10;

        $repository = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande');

        $toHandle_repairs = $repository->findAllRepairsNotHistory($offset, 10);

        $isSuivant = $repository->findAllRepairsNotHistory($offset + 10, 1) ? true : null;

        return $this->render('@RCLABWebsite/Demand/Repair/handle_repair.html.twig', [
            'toHandle_repairs' => $toHandle_repairs,
            'page' => $page,
            'isSuivant' => $isSuivant,
        ]);
    }

    public function myHistoryAction($page)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $offset = $page == 1 ? null : ($page - 1) * 10;

        $repository = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande');

        $my_repairs = $repository->findMyRepairsHistory($user, $offset, 10);
        $isSuivant = $repository->findMyRepairsHistory($user, $offset + 10, 1) ? true : null;

        return $this->render('@RCLABWebsite/Demand/Repair/user_history_repair.html.twig', [
            'my_repairs' => $my_repairs,
            'page' => $page,
            'isSuivant' => $isSuivant,
        ]);
    }

    public function allHistoryAction($page)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page');

        $offset = $page == 1 ? null : ($page - 1) * 10;

        $repository = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande');

        $all_repairs = $repository->findAllRepairsHistory($offset, 10);
        $isSuivant = $repository->findAllRepairsHistory($offset + 10, 1) ? true : null;

        return $this->render('@RCLABWebsite/Demand/Repair/all_history_repair.html.twig', [
            'all_repairs' => $all_repairs,
            'page' => $page,
            'isSuivant' => $isSuivant,
        ]);
    }

    public function detailAction($id)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à la page');

        $repair = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande')->find($id);

        if(!$repair) {

            $this->addFlash('warning', 'Impossible de voir la réparation en détail');
            return $this->redirectToRoute('rclab_website_repair');
        }

        return $this->render('@RCLABWebsite/Demand/Repair/detail_repair.html.twig', array(
            'repair' => $repair,
        ));
    }
}