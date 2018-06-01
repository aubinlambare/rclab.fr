<?php

namespace RCLAB\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatiereType extends AbstractType
{
    private $role;
    private $ajout;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->role = $options['role'];

        if(isset($options['ajout'])) {
            $this->ajout = $options['ajout'];
        }

        if ($this->role == 'admin' || $this->ajout != null) {
            $builder->add('matiere', TextType::class);
        }
        $builder
            ->add('couleur', TextType::class)
            ->add('icone', FileType::class)
            ->add('historique', CheckboxType::class)
            ->add('Valider', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RCLAB\WebsiteBundle\Entity\Matiere',
            'role' => 'user',
            'ajout' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rclab_websitebundle_matiere';
    }


}
