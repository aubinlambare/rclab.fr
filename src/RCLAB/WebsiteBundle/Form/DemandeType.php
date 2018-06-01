<?php

namespace RCLAB\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    private $matieres;
    private $niveaux;
    private $etat;
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->matieres = $options['matieres'];
        $this->niveaux = $options['niveaux'];
        $this->etat = $options['etat'];

        $builder
            ->add('objet', TextType::class)
            ->add('description', TextareaType::class);

        if ($this->etat == 'demande') {

            $builder
                ->add('disponibiliteDemandeur', TextareaType::class);
        } else {

            $builder
                ->add('debut', DateTimeType::class)
                ->add('fin', DateTimeType::class)
                ->add('autorise', CheckboxType::class);
        }

        if (isset($this->matieres)) {
            $builder->add('matiere', ChoiceType::class, [
                'choices' => $this->matieres
            ]);
        }

        if (isset($this->niveaux)) {
            $builder->
            add('niveau', ChoiceType::class, [
                'choices' => $this->niveaux
            ]);
        }

        $builder->add('valider', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RCLAB\WebsiteBundle\Entity\Demande',
            'matieres' => null,
            'niveaux' => null,
            'etat' => null
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
