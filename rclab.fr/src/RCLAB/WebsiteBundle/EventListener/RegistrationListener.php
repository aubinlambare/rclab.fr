<?php
/**
 * Created by PhpStorm.
 * User: aubin
 * Date: 11/04/18
 * Time: 01:35
 */

namespace RCLAB\WebsiteBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegistrationListener implements  EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
          FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
        );

    }

    /**
     * @param FormEvent $event
     */
    public function onRegistrationSuccess(FormEvent $event)
    {
        $roles = array('ROLE_DEFAULT');

        $user = $event->getForm()->getData();
        $user->setRoles($roles);

    }

}