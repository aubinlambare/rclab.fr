<?php
// src/RCLAB/UserBundle/Form/RegistrationType.php
namespace RCLAB\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
<<<<<<< HEAD
            ->add('lastName', TextType::class)
            ->add('firstName', TextType::class)
            ->add('email', EmailType::class, [
                'label' => 'form.email',
                'translation_domain' => 'FOSUserBundle',
                'required' => true,
            ])
            ->add('username', null, ['label' => 'form.username', 'translation_domain' => 'FOSUserBundle'])
=======
            ->add('lastName', TextType::class, [
                'label' => 'form.lastName',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-last-name form-control',
                    'placeholder' => 'Nom...',
                    'id' => 'form-last-name',
                    'required' =>  'required',
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'form.firstName',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-first-name form-control',
                    'placeholder' => 'Prénom...',
                    'id' => 'form-first-name',
                    'required' =>  'required',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'form.email',
                'translation_domain' => 'FOSUserBundle',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-email form-control',
                    'placeholder' => 'Email...',
                    'id' => 'form-email',
                    'required' =>  'required',
                ],
            ])
            ->add('username', null, [
                'label' => 'form.username',
                'translation_domain' => 'FOSUserBundle',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-user-name form-control',
                    'placeholder' => 'Nom d\'utilisateur...',
                    'id' => 'form-email',
                    'required' =>  'required',
                ],
            ])
>>>>>>> 2c1b0752e8cac3fd7c4caa5f95bc6976fd628a14
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => [
                        'autocomplete' => 'new-password',
                    ],
                ],
<<<<<<< HEAD
                'first_options' => ['label' => 'form.password'],
                'second_options' => ['label' => 'form.password_confirmation'],
                'invalid_message' => 'fos_user.password.mismatch',
            ]);
=======
                'first_options' => [
                    'label' => 'form.password',
                    'label_attr' => [
                        'class' => 'sr-only',
                    ],
                    'attr' => [
                        'class' => 'form-password form-control',
                        'placeholder' => 'Mot de passe...',
                        'id' => 'form-password',
                        'required' =>  'required',
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
                        'id' => 'form-password-confirmed',
                        'required' =>  'required',
                    ],
                ],
                'invalid_message' => 'fos_user.password.mismatch',
            ])
        ;
>>>>>>> 2c1b0752e8cac3fd7c4caa5f95bc6976fd628a14
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'RCLAB\UserBundle\Entity\User'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'rclab_userbundle_registration';
    }
}