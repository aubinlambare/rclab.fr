<?php

namespace RCLAB\WebsiteBundle\Form;

use Doctrine\ORM\EntityRepository;
use RCLAB\UserBundle\Entity\User;
use RCLAB\WebsiteBundle\Entity\Demande;
use RCLAB\WebsiteBundle\Entity\Matiere;
use RCLAB\WebsiteBundle\Entity\Niveau;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditCourseType extends AbstractType
{
    /**
     * @var Demande
     */
    private $course;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->course = $options['course'];

        $builder
            ->add('matiere', EntityType::class, [
                'class' => Matiere::class,
                'data' => $this->course->getMatiere(),
                'choice_label' => 'matiere',
                'label' => 'Choisissez une matière pour ce cours',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->where("m.historique = 'false'");
                }
            ])
            ->add('niveau', EntityType::class, [
                'class' => Niveau::class,
                'choice_label' => 'niveau',
                'data' => $this->course->getNiveau(),
                'label' => 'Niveau du cours',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('m')
                    ->where("m.historique = 'false'");
                }
            ])
            ->add('objet', TextType::class, [
                'label' => 'Objet du cours',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Précisez votre demande',
            ])
            ->add('professeur', EntityType::class, [
                'class' => User::class,
                'data' => $this->course->getProfesseur(),
                'required' => false,
                'label' => 'Professeur pour ce cours',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where("u.fonction != 'null'");
                }
            ])
            ->add('debut', DateTimeType::class, [
                'label' => 'Date et heure du cours',
                'data' => $this->course->getDebut() ? $this->course->getDebut() : new \DateTime('NOW + 1days'),
            ])
            ->add('duree', TimeType::class, [
                'label' => 'Durée du cours',
                'data' => new \DateTime('1:0')
            ])
            ->add('Valider', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'RCLAB\WebsiteBundle\Entity\Demande',
            'course' => null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rclab_websitebundle_demande';
    }


}
