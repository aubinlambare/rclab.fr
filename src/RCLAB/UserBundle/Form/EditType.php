<?php

namespace RCLAB\UserBundle\Form;

use RCLAB\WebsiteBundle\Entity\Fonction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditType extends AbstractType
{
    private $user;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder
//            ->add('fonction', EntityType::class, [
//                'class' => Fonction::class,
//
//            ])
//            ->add('roles', )
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'RCLAB\UserBundle\Entity\User',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'rclab_userbundle_registration';
    }
}
