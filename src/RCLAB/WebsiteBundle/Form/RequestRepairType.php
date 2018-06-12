<?php

namespace RCLAB\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestRepairType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('objet', TextType::class, array(
                'label' => 'Objet de la réparation',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Objet de la réparation...',
                ],
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Précisez votre problème',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Détaillez votre problème...',
                    'class' => 'form-control',
                    'rows' => '4',
                ],
            ))
            ->add('disponibiliteDemandeur', TextareaType::class, array(
                'label' => 'Indiquez ici vos disponiblités',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Indiquez vos disponibilités...',
                    'class' => 'form-control',
                    'rows' => '4',
                ],
            ))
            ->add('Envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RCLAB\WebsiteBundle\Entity\Demande',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rclab_websitebundle_demande';
    }


}
