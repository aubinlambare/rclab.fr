<?php
namespace RCLAB\WebsiteBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DefaultController extends Controller
{
    public function indexAction()
    {
        $focus_events = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Event')->findBy(['focus' => 1]);
        $focus_news = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:News')->findBy(['focus' => 1]);
        $listFocus = array_merge($focus_events, $focus_news);
//        $list_focus = [];
//        foreach ($listFocus as $key => $focus) {
//            $list_focus[$key] = \DateTime::createFromFormat('Y-m-d h:i:s', $focus->getTitle());
//        }
//        sort($list_focus);
        $list_courses = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande')->findAllCoursesNotHistory();
        $infoAsso = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Association')->findOneBy([]);
        return $this->render('@RCLABWebsite/Default/index.html.twig', [
            'list_focus' => $listFocus,
            'list_course' => $list_courses,
            'image_default_focus' => $infoAsso->getImageFocus(),
            'text_default_focus' => $infoAsso->getTexteFocus(),
        ]);
    }
    public function contactAction()
    {
        $infoAssociation = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Association')->findOneBy([]);
        $personnes = $this->getDoctrine()->getManager()->getRepository('RCLABUserBundle:User')->findUserFonctionByTri(3);
        return $this->render('@RCLABWebsite/Default/contact.html.twig', array(
            'infoAssociation' => $infoAssociation,
            'personnes' => $personnes,
        ));
    }
}
