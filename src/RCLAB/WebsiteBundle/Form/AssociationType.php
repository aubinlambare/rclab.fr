<?php

namespace RCLAB\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssociationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('facebookAsso', TextType::class, array(
//                'label' => 'Lien vers la page facebook de l\'association',
//                'required' => false,
//            ))
//            ->add('logoAsso', FileType::class, array(
//                'label' => 'Logo de l\'association',
//            ))
            ->add('numeroPermanence', TelType::class, array(
                'label' => 'Numéro de téléphone de permanence',
                'required' => false,
            ))
            ->add('horairesPermanence', TextareaType::class, array(
                'label' => 'Horaires de permanence',
                'required' => false,
            ))
//            ->add('messageAccueil', TextareaType::class, array(
//                'label' => 'Un petit message de bienvenue',
//                'required' => false,
//            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Description de l\'association',
                'required' => false,
            ))
            ->add('imageFocus', FileType::class, array(
                'label' => 'Image en focus',
                'required' => false,
            ))
            ->add('texteFocus', TextareaType::class, array(
                'label' => 'Texte en focus',
                'required' => false,
            ))
            ->add('Enregistrer', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RCLAB\WebsiteBundle\Entity\Association'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rclab_websitebundle_association';
    }


}
