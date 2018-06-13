<?php

namespace RCLAB\WebsiteBundle\Form;

use Doctrine\ORM\EntityRepository;
use RCLAB\WebsiteBundle\Entity\Matiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestCourseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matiere', EntityType::class, [
                'class' => Matiere::class,
                'choice_label' => 'matiere',
                'label' => 'Choisissez une matière pour ce cours',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Choisir une matière',
                    'title' => 'Matière',
                ],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->where("m.historique = 'false'");
                }
            ])
            ->add('objet', TextType::class, array(
                'label' => 'Objet du cours',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Objet du cours...',
                ],
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Précisez votre demande',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Précisez votre demande...',
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
