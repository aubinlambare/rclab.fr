<?php

namespace RCLAB\WebsiteBundle\Controller;

use RCLAB\WebsiteBundle\Entity\Demande;
use RCLAB\WebsiteBundle\Form\EditCourseType;
use RCLAB\WebsiteBundle\Form\RequestCourseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CourseController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function courseAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page !');

        $repository = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $my_course = $repository->findMyCourses($user);

        $all_courses = $repository->findAvailableCourses($user);

        $available_courses = array();

        foreach ($all_courses as $course) {

            $inscrits = $course->getInscrits();

            $nbInscrits = count($inscrits);

            $token = 0;

            foreach ($inscrits as $inscrit) {

                if ($inscrit != $user) $token++;
            }

            if ($token == $nbInscrits) {
                array_push($available_courses, $course);
            }
        }

        $my_demands = $repository->findMyCoursesDemandsNotHistory($user);


        return $this->render('@RCLABWebsite/Demand/Course/course.html.twig', array(
            'my_courses' => $my_course,
            'available_courses' => $available_courses,
            'my_demands' => $my_demands,
        ));
    }


    public function requestAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();

        $demande = new Demande();

        $form = $this->createForm(RequestCourseType::class, $demande);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $demande->setDemandeur($user);

            $tdemande = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:T_Demande')->findOneBy(array('typeDemande' => 'cours'));

            $demande->setTdemande($tdemande);
            $demande->setEtat('demande');

            $em->persist($demande);
            $em->flush();

            $this->addFlash('success', 'La demande a bien été enregistrée');

            return $this->redirectToRoute('rclab_website_course');
        }

        return $this->render('RCLABWebsiteBundle:Demand/Course:request_course.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page');

        $course = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande')->find($id);

        if (!$course) {

            $this->addFlash('warning', 'Impossible de valider cette demande de cours');
            return $this->redirectToRoute('rclab_website_course_handle');
        }

        $form = $this->createForm(EditCourseType::class, $course, [
            'course' => $course,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->get('security.token_storage')->getToken()->getUser();

            $course->setResponsable($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($course);
            $em->flush();

            $this->addFlash('success', 'Cours modifié avec succès');
            return $this->redirectToRoute('rclab_website_course_handle');
        }

        return $this->render('@RCLABWebsite/Demand/Course/edit_course.html.twig', array(
            'form' => $form->createView(),
            'course' => $course,
        ));
    }

    public function handleAction($page)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page');

        $offset = $page == 1 ? null : ($page - 1) * 10;

        $repository = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande');

        $toHandle_courses = $repository->findCoursesToHandle($offset, 10);

        $isSuivant = $repository->findCoursesToHandle($offset + 10, 1) ? true : null;

        return $this->render('RCLABWebsiteBundle:Demand/Course:handle_course.html.twig', [
            'toHandle_courses' => $toHandle_courses,
            'page' => $page,
            'isSuivant' => $isSuivant,
        ]);
    }

    public function refuseAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page');

        $course = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande')->find($id);

        if (!$course) {

            $this->addFlash('warning', 'Impossible de refuser cette demande');
            return $this->redirectToRoute('rclab_website_course_handle');
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $course->setEtat('refusé');
        $course->setResponsable($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($course);
        $em->flush();

        $this->addFlash('success', 'Cette demande de cours a été refusée');

        return $this->redirectToRoute('rclab_website_course_handle');
    }

    public function validAction($id, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page');

        $course = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande')->find($id);

        if (!$course) {

            $this->addFlash('warning', 'Impossible de valider cette demande de cours');
            return $this->redirectToRoute('rclab_website_course_handle');
        }

        $form = $this->createForm(EditCourseType::class, $course, array(
            'course' => $course,
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->get('security.token_storage')->getToken()->getUser();

            $course->setResponsable($user);
            $course->setEtat('validé');
            $course->addInscrit($course->getDemandeur());

            $em = $this->getDoctrine()->getManager();
            $em->persist($course);
            $em->flush();

            $this->addFlash('success', 'Cours validé avec succès');
            return $this->redirectToRoute('rclab_website_course_handle');
        }

        return $this->render('@RCLABWebsite/Demand/Course/edit_course.html.twig', array(
            'form' => $form->createView(),
            'course' => $course,
        ));
    }

    public function myHistoryAction($page)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $repository = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande');

        $offset = $page == 1 ? null : ($page - 1) * 10;

        $my_courses = $repository->findMyCoursesHistory($user, $offset, 10);
        $isSuivant = $repository->findMyCoursesHistory($user, $offset + 10, 1) ? true : null;
//        $my_demands = $repository->findMyCoursesDemandsHistory($user);

        return $this->render('@RCLABWebsite/Demand/Course/user_history_course.html.twig', [
//            'my_demands' => $my_demands,
            'my_courses' => $my_courses,
            'page' => $page,
            'isSuivant' => $isSuivant,
        ]);
    }

    public function allHistoryAction($page)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page');

        $offset = $page == 1 ? null : ($page - 1) * 10;

        $repository = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande');
        $all_courses = $repository->findAllCoursesHistory($offset, 10);
        $isSuivant = $repository->findAllCoursesHistory($offset + 10, 1) ? true : null;

        return $this->render('@RCLABWebsite/Demand/Course/all_history_course.html.twig', [
            'all_courses' => $all_courses,
            'page' => $page,
            'isSuivant' => $isSuivant,
        ]);
    }

    public function subscribeAction($id)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page');

        $course = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande')->find($id);

        if (!$course) {
            $this->addFlash('warning', 'Impossible de s\'inscrire à ce cours');
            return $this->redirectToRoute('rclab_website_course');
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $course->addInscrit($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($course);
        $em->flush();

        $this->addFlash('success', 'Vous êtes désormais inscrits à ce cours');
        return $this->redirectToRoute('rclab_website_course');
    }

    public function unsubscribeAction($id)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page');

        $course = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande')->find($id);


        if (!$course) {

            $this->addFlash('warning', 'Impossible de se désinscrire à ce cours');
            return $this->redirectToRoute('rclab_website_course');
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $course->removeInscrit($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($course);
        $em->flush();

        $this->addFlash('success', 'Vous vous êtes désinscrit de ce cours');
        return $this->redirectToRoute('rclab_website_course');
    }

    public function detailAction($id)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page');

        $course = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande')->find($id);

        if (!$course) {

            $this->addFlash('warning', 'Impossible de voir ce cours en détail');
            return $this->redirectToRoute('rclab_website_course');
        }

        return $this->render('RCLABWebsiteBundle:Demand/Course:detail_course.html.twig', [
            'course' => $course
        ]);
    }
}