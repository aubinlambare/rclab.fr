<?php

namespace RCLAB\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('event', TextType::class)
            ->add('description', TextareaType::class)
            ->add('lien', UrlType::class)
            ->add('image', FileType::class)
            ->add('maxParticipants', IntegerType::class, array('attr' => array(
                'min' => 1,
                'max' => 32767,
            )))
            ->add('debutEvent', DateTimeType::class)
            ->add('finEvent', DateTimeType::class)
            ->add('debutPublication', DateTimeType::class)
            ->add('finPublication', DateTimeType::class)
            ->add('focus', CheckboxType::class)
//            ->add('prioriteFocus', IntegerType::class, array('attr' => array(
//                'min' => 1,
//                'max' => 10,
//            )))
            ->add('Valider', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RCLAB\WebsiteBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rclab_websitebundle_event';
    }


}
