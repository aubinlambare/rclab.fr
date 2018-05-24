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
            ->add('facebook', TextType::class, [
                'label' => 'Facebook',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-facebook form-control',
                    'placeholder' => 'Profil facebook...',
                ],
                'required' => false
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-telephone form-control',
                    'placeholder' => 'Numéro de téléphone...',
                ],
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-email form-control',
                    'placeholder' => 'Email...',
                ],
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
                'first_options' => [
                    'label' => 'form.password',
                    'label_attr' => [
                        'class' => 'sr-only',
                    ],
                    'attr' => [
                        'class' => 'form-password form-control',
                        'placeholder' => 'Nouveau mot de passe...',
                    ],
                ],
                'second_options' => [
                    'label' => 'form.password_confirmation',
                    'label_attr' => [
                        'class' => 'sr-only',
                    ],
                    'attr' => [
                        'class' => 'form-password-confirmed form-control',
                        'placeholder' => 'Confirmer le mot de passe...',
                    ],
                ],
                'invalid_message' => 'fos_user.password.mismatch',
            ]);

        if (!is_null($this->function)) {
            $builder->add('photo', FileType::class, [
                'label' => 'Photo',
                'required' => false,
                'label_attr' => [
                    'id' => 'fileButton',
                ],
                'attr' => [
                    'id' => 'fileButton',
                ],
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
