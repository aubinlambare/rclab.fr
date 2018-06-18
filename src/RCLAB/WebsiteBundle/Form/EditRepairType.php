<?php

namespace RCLAB\WebsiteBundle\Form;

use Doctrine\ORM\EntityRepository;
use RCLAB\UserBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditRepairType extends AbstractType
{
    private $etat;
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->etat = $options['etat'];
        $choices = [
          'en attente' => 'en attente',
            'en cours' => 'en cours',
            'terminée' => 'terminée',
        ];

        if($this->etat == 'terminée') {
            $choices['délivrée'] = 'délivrée';
        }

        $builder
            ->add('objet', TextType::class, [
                'label' => 'Objet de la réparation',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Objet du cours...',
                    'class' => 'form-control',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Précisez votre problème',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Précisez la demande...',
                    'class' => 'form-control',
                    'rows' => '4',
                ],
            ])
            ->add('etat', ChoiceType::class, [
                'label' => 'Etat de la réparation',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'choices' => $choices,
            ])
            ->add('responsable', EntityType::class, [
                'label' => 'Responsable de cette réparation',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where("u.fonction != 'null'");
                }
            ])
            ->add('Valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);

            if($this->etat == 'demande') {
                $builder->add('debut', DateTimeType::class, [
                   'label' => 'Date et heure du rendez-vous',
                    'label_attr' => [
                        'class' => 'sr-only',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'data' => new \DateTime()
                ]);
            }

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RCLAB\WebsiteBundle\Entity\Demande',
            'etat' => null,
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
