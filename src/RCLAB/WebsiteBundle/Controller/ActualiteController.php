<?php
/**
 * Created by PhpStorm.
 * User: aubin
 * Date: 23/04/18
 * Time: 00:17
 */
namespace RCLAB\WebsiteBundle\Controller;
use RCLAB\UserBundle\Entity\User;
use RCLAB\WebsiteBundle\Entity\Event;
use RCLAB\WebsiteBundle\Entity\EventInscrit;
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
            /**
             * @var UploadedFile
             */
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
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function actualiteAction($page)
    {
        $nb_max_actus = 12;
        $offset = $page == 1 ? null : ($page - 1) * $nb_max_actus;
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('RCLABWebsiteBundle:Event')->findAll();
        $news = $em->getRepository('RCLABWebsiteBundle:News')->findAll();
        $listActu = array_merge($events, $news);
        $date_start = [];
        foreach ($listActu as $key => $actu) {
            $date_start[$key] = \DateTime::createFromFormat('Y-m-d h:i:s', $actu->getTitle());
        }
        sort($date_start);
        $list = array_merge($news, $events);
        $actus = array_slice($list, $offset, $nb_max_actus);
        $isSuivant = array_slice($list, $offset + $nb_max_actus, 1) ? true : null;
        return $this->render('@RCLABWebsite/Actualite/actualite.html.twig', [
            'page' => $page,
            'listActus' => $actus,
            'isSuivant' => $isSuivant,
        ]);
    }
//    /**
//     * @param $page
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function eventsAction($page)
//    {
//        $nb_max_events = $this->isGranted('ROLE_MODERATOR') ? 11 : 12;
//
//        $offset = $page == 1 ? null : ($page - 1) * $nb_max_events;
//
//        $em = $this->getDoctrine()->getManager();
//
//        $events = $em->getRepository('RCLABWebsiteBundle:Event')->findAll();
//        $news = $em->getRepository('RCLABWebsiteBundle:News')->findAll();
//
//        $listActu = array_merge($events, $news);
//
//        $date_start = [];
//
//        foreach ($listActu as $key => $actu) {
//            $date_start[$key] = \DateTime::createFromFormat('Y-m-d h:i:s', $actu->getTitle());
//        }
//        sort($date_start);
//
//        $list = array_merge($news, $events);
//
//        $actus = array_slice($list, $offset, $nb_max_events);
//
//        $isSuivant = array_slice($list, $offset + $nb_max_events, 1) ? true : null;
//
//        return $this->render('@RCLABWebsite/Actualite/Events/events.html.twig', [
//            'page' => $page,
//            'listEvents' => $actus,
//            'isSuivant' => $isSuivant,
//        ]);
//    }
//
//    /**
//     * @param $page
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function newsAction($page)
//    {
//        $nb_max_news = 10;
//        $offset = $page == 1 ? null : ($page - 1) * $nb_max_news;
//
//        $repository = $this->getDoctrine()->getManager()->getRepository('RCLABWebsiteBundle:News');
//
//        $listNews = $repository->findBy(
//            [],
//            ['share_date' => 'desc'],
//            $nb_max_news,
//            $offset
//        );
//
//        $suivant = $repository->findBy(
//            [],
//            [],
//            1,
//            ($offset + $nb_max_news)
//        );
//
//        $isSuivant = $suivant ? true : null;
//
//        return $this->render('@RCLABWebsite/Actualite/News/news.html.twig', [
//            'page' => $page,
//            'listNews' => $listNews,
//            'isSuivant' => $isSuivant,
//        ]);
//    }
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
            return $this->redirectToRoute('rclab_website_actualite', ['page'=>1]);
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
            return $this->redirectToRoute('rclab_website_actualite', ['page'=>1]);
        }
        return $this
            ->render('@RCLABWebsite/Actualite/Events/add_event.html.twig', [
                'form' => $form->createView(),
            ]);
    }
    /**
     * @param Request $request
     * @param News $news
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeNewsAction(Request $request, News $news)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');
        $request->getSession()->set('referer', $request->headers->get('referer'));
        $em = $this->getDoctrine()->getManager();
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
        return $this->redirect($request->getSession()->get('referer'));
    }
    /**
     * @param Request $request
     * @param Event $event
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeEventAction(Request $request, Event $event)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');
        $request->getSession()->set('referer', $request->headers->get('referer'));
        $em = $this->getDoctrine()->getManager();
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
        return $this->redirect($request->getSession()->get('referer'));
    }
    public function newsDetailAction(News $news)
    {
        return $this->render('@RCLABWebsite/Actualite/News/detail_news.html.twig', ['news' => $news]);
    }
    public function eventDetailAction(Event $event)
    {
        return $this->render('@RCLABWebsite/Actualite/Events/detail_event.html.twig', ['event' => $event]);
    }
    /**
     * @param News $news
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editNewsAction(News $news, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');
        $request->getSession()->set('referer', $request->headers->get('referer'));
        $form = $this->Form($request, 'News', $news);
        if ($form == false) {
            $this->addFlash('success', 'La news a bien été modifiée');
            return $this->redirect($request->getSession()->get('referer'));
        }
        return $this->render('@RCLABWebsite/Actualite/News/edit_news.html.twig', [
            'form' => $form->createView(),
            'news' => $news,
        ]);
    }
    /**
     * @param Event $event
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editEventAction(Event $event, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page !');
        $request->getSession()->set('referer', $request->headers->get('referer'));
        $form = $this->Form($request, 'Event', $event);
        if ($form == false) {
            $this->addFlash('success', 'L\'évènement a bien été modifié');
            return $this->redirect($request->getSession()->get('referer'));
        }
        return $this->render('@RCLABWebsite/Actualite/Events/edit_event.html.twig', [
            'form' => $form->createView(),
            'event' => $event,
        ]);
    }
    public function subscribeEventAction(Request $request, Event $event)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page');
        $request->getSession()->set('referer', $request->headers->get('referer'));
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $eventInscrit = new EventInscrit();
        $eventInscrit->setEvent($event);
        $eventInscrit->setInscrit($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($eventInscrit);
        $em->persist($event);
        $em->flush();
        $this->addFlash('success', 'Votre inscription a bien été prise en compte, elle vous sera confirmée par mail');
        //TODO: Envoi d'un mail à l'utilisateur pour le prévenir
        return $this->redirect($request->getSession()->get('referer'));
    }
    public function confirmationSubscriptionEventAction(Event $event, User $user)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossibble d\'accéder à cette page');
        $eventInscrit = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:EventInscrit')->findOneBy([
            'event' => $event,
            'inscrit' => $user,
        ]);
        $eventInscrit->setIsInscrit(1);
        $event->setNbInscrits($event->getNbInscrits() + 1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($eventInscrit);
        $em->persist($event);
        $em->flush();
        $this->addFlash('success', 'L\'utilisateur est inscrit à l\'évènement');
        //TODO: Envoi un mail à l'utilisateur pour le prévenir
        return $this->redirectToRoute('rclab_website_actualite_events_handleSubscription', [
            'id' => $event->getId(),
        ]);
    }
    public function unsubscribeEventAction(Event $event, User $user)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page');
        $eventInscrit = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:EventInscrit')->findOneBy([
            'event' => $event,
            'inscrit' => $user,
        ]);
        $em = $this->getDoctrine()->getManager();
        $em->remove($eventInscrit);
        $em->flush();
        $this->addFlash('success', 'Inscription refusée avec succès');
        //TODO: Envoi d'un mail à l'utilisateur désinscrit pour le prévenir
        return $this->redirectToRoute('rclab_website_actualite_events_handleSubscription', [
            'id' => $event->getId(),
        ]);
    }
    public function handleEventsAction()
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page');
        $listEvents = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Event')->findEventsToHandle();
        return $this->render('@RCLABWebsite/Actualite/Events/handle_event.html.twig', [
            'list_event' => $listEvents,
        ]);
    }
    public function handleSubscriptionEventAction(Event $event)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'Impossible d\'accéder à cette page');
        $list_inscrits = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:EventInscrit')->findBy([
            'event' => $event,
        ]);
        return $this->render('RCLABWebsiteBundle:Actualite/Events:handleSubscription_event.html.twig', [
            'event' => $event,
            'list_inscrits' => $list_inscrits,
        ]);
    }
}