<?php

namespace RCLAB\UserBundle\Form;

use RCLAB\WebsiteBundle\Entity\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('facebook', TextType::class, [
                'label' => 'Facebook',
                'required' => false
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone',
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'translation_domain' => 'FOSUserBundle'
            ])
            ->add('plainPassword', RepeatedType::class, [
                'required' => false,
                'type' => PasswordType::class,
                'options' => [
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => [
                        'autocomplete' => 'new-password',
                    ],
                ],
                'first_options' => ['label' => 'form.password'],
                'second_options' => ['label' => 'form.password_confirmation'],
                'invalid_message' => 'fos_user.password.mismatch',
            ]);

        if (!is_null($this->function)) {
            $builder->add('Photo', Image::class, [
                'label' => 'Photo',
                'required' => false,
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'RCLAB\UserBundle\Entity\User',
            'function' => null
        ]);
    }

    public function getBlockPrefix()
    {
        return 'rclab_userbundle_registration';
    }
}
