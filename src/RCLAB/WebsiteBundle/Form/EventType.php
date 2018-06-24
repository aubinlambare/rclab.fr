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
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Titre de l\'événement...',
                    'class' => 'form-control',
                ],
            ])
            ->add('description', TextareaType::class, array(
                'label' => 'Décrivez l\'événement',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Décrivez l\'événement...',
                    'class' => 'form-control',
                    'rows' => '4',
                ],
            ))
            ->add('link', UrlType::class, [
                'label' => 'lien',
                'required' => false,
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Lien...',
                    'class' => 'form-control',
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'Affiche',
                'required' => false,
                'label_attr' => [
                    'id' => 'fileButton',
                ],
                'attr' => [
                    'id' => 'fileButton',
                ],
            ])
            ->add('maxParticipants', IntegerType::class, [
                'label' => 'Nombre maximum de participants',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => false,
                'attr' => [
                    'min' => 1,
                    'max' => 32767,
                    'class' => 'integer',
                ],
            ])
            ->add('dateStart', DateTimeType::class, [
                'label' => 'Date de début de l\'évènement',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('dateEnd', DateTimeType::class, [
                'label' => 'Date de fin de l\'évènement',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('shareDate', DateTimeType::class, [
                'label' => 'Date de publication',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('focus', CheckboxType::class, [
                'label' => 'Mettre l\'évènement en focus',
                'required' => false,
                'label_attr' => [
                    'class' => 'sr-only',
                ],
            ])
//            ->add('prioriteFocus', IntegerType::class, array('attr' => array(
//                'min' => 1,
//                'max' => 10,
//            )))
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