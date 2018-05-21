<?php
/**
 * Created by PhpStorm.
 * User: aubin
 * Date: 17/04/18
 * Time: 21:25
 */

namespace RCLAB\UserBundle\Controller;

use RCLAB\UserBundle\Entity\User;
use RCLAB\UserBundle\Form\ProfileUpdateType;
use RCLAB\WebsiteBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function usersAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $superAdmin = $this->get('rclab_user.service.role')->isGranted('ROLE_SUPER_ADMIN', $user);


        $users = $this->getDoctrine()->getManager()->getRepository('RCLABUserBundle:User')->findUsers($superAdmin);

        return $this->render('@RCLABUser/User/users.html.twig', [
            'users' => $users,
        ]);
    }

    public function profileAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Impossible d\'accéder à cette page !');

        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $function = null;
        if (!empty($user->getFonction())) {
            $function = 1;
        }

        $form = $this->createForm(ProfileUpdateType::class, $user, [
            'function' => $function
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        dump($form);die;
           //if($user->getPhoto())

          //  $image = new Image('image_directory', $form->getData());

            //$user->setPhoto($image->getId());

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Le profil a bien été mis à jour');

            return $this->redirectToRoute('rclab_user_profile');
        }


        return $this->render('@RCLABUser/User/profile.html.twig', ['form' => $form->createView(),
            'user' => $user,]);
    }

    public function resetPhotoAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('RCLABUserBundle:User')->find($id);

        if (!$user) {

            $this->addFlash('error', 'La photo n\'a pas pu être réinitialisée');
        } else {

            $this->addFlash('success', 'La photo a bien été réinitialisée');
            $this->get('rclab_website.remove.file')->removeFile($user->getPhoto());
            $user->setPhoto('default.jpg');
            $em->persist($user);
            $em->flush();
        }
        return $this->redirectToRoute('rclab_user_users_list');

    }

    public function editAction(Request $request, User $user)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();

        $userFunction = null == $user->getFonction() ? '' : $user->getFonction();
        $Listfunctions = $em->getRepository('RCLABWebsiteBundle:Fonction')->findAll();
        $functions = [];
        foreach ($Listfunctions as $function) {
            $code = $function->getFonction();
            $functions[$code] = $code;
        }

        $roles = [
            'utilisateur' => 'ROLE_USEhttps://www.google.com/search?q=check+mime+type+symfony&ie=utf-8&oe=utf-8&client=firefox-bR',
            'modérateur' => 'ROLE_MODERATOR'
        ];
        if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $roles['administrateur'] = 'ROLE_ADMIN';
        }

        $formBuilder = $this->createFormBuilder();

        if ($user != $this->get('security.token_storage')->getToken()->getUser()) {

            $formBuilder
                ->add('role', ChoiceType::class, [
                    'data' => $user->getRoles()[0],
                    'choices' => $roles,
                ]);
        }
        $form = $formBuilder
            ->add('fonction', ChoiceType::class, [
                'data' => $userFunction,
                'placeholder' => 'Choisir une fonction',
                'choices' => $functions,
                'required' => false
            ])
            ->add('Valider', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $fonction = $em->getRepository('RCLABWebsiteBundle:Fonction')->findOneBy(['fonction' => $data['fonction']]);

            $user->setFonction($fonction);

            if (isset($data['role'])) {
                $role = $user->getRoles()[0];
                $user->removeRole($role);
                $user->addRole($data['role']);
            }

            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success', 'L\'utilisateur a bien été modifié'
            );
            return $this->redirectToRoute('rclab_user_users_list');
        }


        return $this->render('@RCLABUser/User/gestionUser.html.twig', [
            'user' => $user,
            'fonctions' => $functions,
            'roles' => $roles,
            'form' => $form->createView()
        ]);


    }

    public function removeAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Impossible d\'accéder à cette page !');

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('RCLABUserBundle:User')->find($id);

        if (!$user) {

            $this->addFlash('error', 'L\'utilisateur n\'a pas pu être supprimé');

        } elseif ($this->get('rclab_user.service.role')->isGranted('ROLE_ADMIN', $user) && !$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {

            $this->addFlash('error', 'Vous n\'avez pas les droits pour supprimer cet utilisateur');

        } elseif ($this->get('rclab_user.service.role')->isGranted('ROLE_SUPER_ADMIN', $user)) {

            $this->addFlash('error', 'Vous n\'avez pas les droits pour supprimer cet utilisateur');

        } else {

            $this->get('rclab_website.remove.file')->removeFile($user->getPhoto());
            $em->remove($user);
            $em->flush();

            $this->addFlash(
                'success', 'L\'utilisateur a bien été supprimé'
            );
        }
        return $this->redirectToRoute('rclab_user_users_list');
    }
}