<?php

namespace RCLAB\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FonctionType extends AbstractType
{
    private $function;
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if(isset($options['function'])) {

            $this->function = $options['function'];
        }

        $data = is_null($this->function) ? 10 : $this->function->getTri();

        $builder
            ->add('fonction', TextType::class)
            ->add('tri', IntegerType::class, array(
                'data' => $data,
                'label' => 'Priorité',
                'required' => false,
                'attr' => array(
                    'min' => 1,
                    'max' => 10
                )
            ))
            ->add('Valider', SubmitType::class)
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RCLAB\WebsiteBundle\Entity\Fonction',
            'function' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rclab_websitebundle_fonction';
    }


}
