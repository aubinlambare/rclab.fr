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
            $choices['délivré'] = 'délivré';
        }

        $builder
            ->add('objet', TextType::class, [
                'label' => 'Objet de la réparation',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Précisez votre problème',
            ])
            ->add('etat', ChoiceType::class, [
                'label' => 'Etat de la réparation',
                'choices' => $choices,
            ])
            ->add('responsable', EntityType::class, [
                'label' => 'Responsable de cette réparation',
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where("u.fonction != 'null'");
                }
            ])
            ->add('Valider', SubmitType::class);

            if($this->etat == 'demande') {
                $builder->add('debut', DateTimeType::class, [
                   'label' => 'Date et heure du rendez-vous',
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
