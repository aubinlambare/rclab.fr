<?php
/**
 * Created by PhpStorm.
 * User: aubin
 * Date: 23/04/18
 * Time: 00:17
 */

namespace RCLAB\WebsiteBundle\Controller;


use RCLAB\WebsiteBundle\Entity\Event;
use RCLAB\WebsiteBundle\Entity\News;
use RCLAB\WebsiteBundle\Form\EventType;
use RCLAB\WebsiteBundle\Form\NewsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class ActualiteController extends Controller
{
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    /**
     * @param $request
     * @param $type
     * @param $entity
     * @return bool|\Symfony\Component\Form\FormInterface
     */
    private function Form($request, $type, $entity)
    {
        if ($type == 'News') {

            if (is_null($entity)) {

                $obj = new News();
            } else {

                $obj = $entity;
            }
            $oldImage = $obj->getImage();
            $obj->setImage(null);

            $form = $this->createForm(NewsType::class, $obj);

        } else {

            if (is_null($entity)) {

                $obj = new Event();
            } else {

                $obj = $entity;
            }
            $oldImage = $obj->getImage();
            $obj->setImage(null);

            $form = $this->createForm(EventType::class, $obj);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $obj->getImage();
            if (!empty($file)) {
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $file->move(
                    $this->getParameter('image_directory'),
                    $fileName
                );
                $obj->setImage($fileName);
                $this->get('rclab_website.remove.file')->removeFile($oldImage);
            } else {

                $obj->setImage($oldImage);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($obj);
            $em->flush();

            return false;
        }

        return $form;

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function actualiteAction()
    {

        return $this->render('@RCLABWebsite/Actualite/actualite.html.twig');
    }


    /**
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function eventsAction($page)
    {
        $offset = $page == 1 ? null : ($page - 1) * 12;

        $repository = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:Event');

        $listEvents = $repository->findBy(
            array('finEvent' => 'desc'),
            12,
            $offset
        );

        $suivant = $repository->findBy(
            [],
            [],
            1,
            ($offset + 12)
        );

        $isSuivant = $suivant ? true : null;

        return $this->render('@RCLABWebsite/Actualite/Events/events.html.twig', [
            'page' => $page,
            'listEvents' => $listEvents,
            'isSuivant' => $isSuivant,
        ]);
    }

    /**
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newsAction($page)
    {
        $offset = $page == 1 ? null : ($page - 1) * 10;

        $repository = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:News');

        $listNews = $repository->findBy(
            [],
            ['debutPublication' => 'desc'],
            10,
            $offset
        );

        $suivant = $repository->findBy(
            [],
            [],
            1,
            ($offset + 10)
        );

        $isSuivant = $suivant ? true : null;

        return $this->render('@RCLABWebsite/Actualite/News/news.html.twig', [
            'page' => $page,
            'listNews' => $listNews,
            'isSuivant' => $isSuivant,
        ]);
    }

    /**
     * @param Request $request
     * @param
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addNewsAction(Request $request)
    {

        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');
        $form = $this->Form($request, 'News', null);

        if ($form == false) {
            $this->addFlash(
                'success', 'La news a bien été ajoutée'
            );
            return $this->redirectToRoute('rclab_website_actualite_news');
        }

        return $this
            ->render('@RCLABWebsite/Actualite/News/add_news.html.twig', [
                'form' => $form->createView(),
            ]);
    }

    /**
     * @param Request $request
     * @param
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addEventAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');


        $form = $this->Form($request, 'Event', null);

        if ($form == false) {

            $this->addFlash('success', 'L\'évènement a bien été ajouté');
            return $this->redirectToRoute('rclab_website_actualite_events');
        }

        return $this
            ->render('@RCLABWebsite/Actualite/Events/add_event.html.twig', [
                'form' => $form->createView(),
            ]);
    }

    /**
     * @param $id
     * @param
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeNewsAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');


        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('RCLABWebsiteBundle:News')->find($id);

        $this->get('rclab_website.remove.file')->removeFile($news->getImage());
        $em->remove($news);
        $em->flush();

        if ($news == null) {
            $this->addFlash(
                'error', 'La news n\'a pas pu être supprimé'
            );
        } else {
            $this->addFlash(
                'success', 'La news a bien été supprimé'
            );
        }

        return $this->redirectToRoute('rclab_website_actualite_news');
    }

    /**
     * @param $id
     * @param
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeEventAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('RCLABWebsiteBundle:Event')->find($id);

        $this->get('rclab_website.remove.file')->removeFile($event->getImage());
        $em->remove($event);
        $em->flush();

        if ($event == null) {
            $this->addFlash(
                'error', 'L\'évènement n\'a pas pu être supprimé'
            );
        } else {
            $this->addFlash(
                'success', 'L\'évènement a bien été supprimé'
            );
        }

        return $this->redirectToRoute('rclab_website_actualite_events');
    }

    public function newsDetailAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('RCLABWebsiteBundle:News')->find($id);

        return $this->render('@RCLABWebsite/Actualite/News/detail_news.html.twig', ['news' => $news]);
    }

    public function eventDetailAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('RCLABWebsiteBundle:Event')->find($id);

        return $this->render('@RCLABWebsite/Actualite/Events/detail_event.html.twig', [
            'event' => $event,
            'logo_asso' => $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:Association')->findOneBy(array())->getLogoAsso()
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @param
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editNewsAction($id, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('RCLABWebsiteBundle:News')->find($id);

        $form = $this->Form($request, 'News', $news);

        if ($form == false) {

            $this->addFlash('success', 'La news a bien été modifiée');
            return $this->redirectToRoute('rclab_website_actualite_news');
        }

        return $this->render('@RCLABWebsite/Actualite/News/edit_news.html.twig', [
            'form' => $form->createView(),
            'news' => $news,
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @param
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editEventAction($id, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('RCLABWebsiteBundle:Event')->find($id);

        if (!$event) {
            $this->addFlash('error', 'L\'évènement n\'a pas pu être modifié');
            return $this->redirectToRoute('rclab_website_actualite_events');
        } else {

            $form = $this->Form($request, 'Event', $event);

            if ($form == false) {

                $this->addFlash('success', 'L\'évènement a bien été modifié');
                return $this->redirectToRoute('rclab_website_actualite_events');
            }
        }

        return $this->render('@RCLABWebsite/Actualite/Events/edit_event.html.twig', [
            'form' => $form->createView(),
            'event' => $event,
        ]);
    }
}