<?php

namespace RCLAB\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileUpdateType extends AbstractType
{
    private $function;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->function = $options['function'];

        $builder
            ->add('facebook', TextType::class, array(
                'label' => 'Facebook',
                'required' => false
            ))
            ->add('telephone', TelType::class, array(
                'label' => 'Téléphone',
                'required' => false
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Adresse email',
                'translation_domain' => 'FOSUserBundle'
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'required' => false,
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ));

        if (!is_null($this->function)) {
            $builder->add('photo', FileType::class, array(
                'label' => 'Photo',
                'required' => false,
            ));
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RCLAB\UserBundle\Entity\User',
            'function' => null
        ));
    }

    public function getBlockPrefix()
    {
        return 'rclab_userbundle_registration';
    }
}
