<?php
// src/RCLAB/UserBundle/Form/RegistrationType.php
namespace RCLAB\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('plainPassword', RepeatedType::class, [
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
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'RCLAB\UserBundle\Entity\User'
        ]);
    }

    public function getName()
    {
        return 'rclab_user_registration';
    }
}