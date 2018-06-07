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
            ->add('title', TextType::class, [
                'label' => 'titre',
            ])
            ->add('description', TextareaType::class)
            ->add('link', UrlType::class, [
                'label' => 'lien',
            ])
            ->add('image', FileType::class, [
                'label' => 'Affiche',
            ])
            ->add('maxParticipants', IntegerType::class, [
                'label' => 'Nombre maximum de participants',
                'attr' => [
                    'min' => 1,
                    'max' => 32767,
                ],
            ])
            ->add('dateStart', DateTimeType::class, [
                'label' => 'Date de début de l\'évènement',
            ])
            ->add('dateEnd', DateTimeType::class, [
                'label' => 'Date de fin de l\'évènement',
            ])
            ->add('shareDate', DateTimeType::class, [
                'label' => 'Date de publication',
            ])
            ->add('focus', CheckboxType::class, [
                'label' => 'Mettre l\'évènement en focus'
            ])
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