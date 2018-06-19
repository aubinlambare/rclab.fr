<?php

namespace RCLAB\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class T_DemandeType extends AbstractType
{

    private $role;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->role = $options['role'];

        if ($this->role == 'super_admin') {
            $builder->add('typeDemande', TextType::class);
        }

        $builder
            ->add('typeDemande', TextType::class, array(
                'label' => 'Nom du type',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Nom du type...',
                    'class' => 'form-control',
                ],
            ))
            ->add('couleur', TextType::class, array(
                'label' => 'Couleur du type',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Couleur du type...',
                    'class' => 'form-control',
                ],
            ))
            ->add('icone', FileType::class, [
                'label' => 'icone',
                'required' => false,
                'label_attr' => [
                    'id' => 'fileButton',
                ],
                'attr' => [
                    'id' => 'fileButton',
                ],
            ])
            ->add('historique', CheckboxType::class, array(
                'label' => 'Historique',
                'required' => false,
                'label_attr' => [
                    'class' => 'sr-only',
                ],
            ))
            ->add('Valider', SubmitType::class, [
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
            'data_class' => 'RCLAB\WebsiteBundle\Entity\T_Demande',
            'role' => 'user'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rclab_websitebundle_t_demande';
    }


}
