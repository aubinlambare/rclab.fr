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

        $info_asso = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Association')->findOneBy([]);


        $list_courses = $this->getDoctrine()->getRepository('RCLABWebsiteBundle:Demande')->findAllCoursesNotHistory();
        return $this->render('@RCLABWebsite/Default/index.html.twig', [
            'list_focus' => $listFocus,
            'list_course' => $list_courses,
            'image_default_focus' => $info_asso->getImageFocus(),
        ]);
    }
    public function contactAction()
    {
        $infoAssociation = $this->getDoctrine();
        $personnes = $this->getDoctrine()->getManager()->getRepository('RCLABUserBundle:User')->findUserFonctionByTri(3);
        return $this->render('@RCLABWebsite/Default/contact.html.twig', array(
            'infoAssociation' => $infoAssociation,
            'personnes' => $personnes,
        ));
    }
}
