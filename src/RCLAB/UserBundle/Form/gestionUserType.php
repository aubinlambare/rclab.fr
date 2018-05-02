<?php

namespace RCLAB\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class gestionUserType extends AbstractType
{
    private $functions;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->functions = $options['functions'];
        array_unshift($this->functions, '');

        $builder
            ->add('fonction', ChoiceType::class, array(
               'choices' => $this->functions
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RCLAB\UserBundle\Entity\User',
            'function' => '',
            'statut' => null
        ));
    }

    public function getBlockPrefix()
    {
        return 'rclab_userbundle_registration';
    }
}
