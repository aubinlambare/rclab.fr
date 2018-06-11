<?php
/**
 * Created by PhpStorm.
 * User: aubin
 * Date: 19/04/18
 * Time: 23:07
 */
namespace RCLAB\UserBundle\Controller;
use RCLAB\UserBundle\Entity\User;
use RCLAB\UserBundle\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function registerAction(Request $request)
    {
        if(true == $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->redirectToRoute('rclab_website_home');
        }

        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $response = $form->getData();

            $secret = "6LeTG1oUAAAAAMLikUWdo4o3qxRcXqhJL7GDPGop";

            //paramètres renvoyés par le captcha
            $captcha = $request->request->get('g-recaptcha-response');

            //on récupère l'ip de l'utilisateur
            $remoteip = $request->getClientIp();

            $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
                . $secret
                . "&response=" . $captcha
                . "&remoteip=" . $remoteip ;

            $decode = json_decode(file_get_contents($api_url), true);

            if ($decode['success'] == false) {

                $this->addFlash('warning', "Captcha invalide");
                return $this->render('@RCLABUser/User/registration.html.twig', [
                    'form' => $form->createView()
                ]);

            }

            $confirmationToken = md5(microtime(TRUE) * 10000);

            $user->setConfirmationToken($confirmationToken);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            //creation du mail de confirmation
            $mailer = $this->get('mailer');
            $message = (new \Swift_Message('Confirmer votre inscription'))
                ->setFrom('noreply@rclab.fr', 'Root Computer Lab')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView('@RCLABUser/Emails/email_registration.html.twig', ['confirmationToken' => $confirmationToken]),
                    'text/html'
                );
            $mailer->send($message);

            return $this->render('@RCLABUser/User/check_email.html.twig');
        }
        return $this->render('@RCLABUser/User/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function checkEmailAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(User::class)->findOneBy([
            'confirmationToken' => $id
        ]);

        if (empty($user)) {

            throw new NotFoundHttpException('Sorry not existing!');
        } else {

            $user->setEnabled(true);
            $user->setConfirmationToken(null);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre inscription a bien été confirmée !');

            //login
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_users', serialize($token));

            return $this->render('@RCLABWebsite/Default/index.html.twig');
        }
    }
}