<?php
namespace RCLAB\WebsiteBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class NewsType extends AbstractType
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
                    'placeholder' => 'Titre de la news...',
                    'class' => 'form-control',
                ],
            ])
            ->add('description', TextareaType::class, array(
                'label' => 'Décrivez la news',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'attr' => [
                    'placeholder' => 'Décrivez la news',
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
                'label' => 'Mettre en focus',
                'required' => false,
                'label_attr' => [
                    'class' => 'sr-only',
                ],
            ])
//            ->add('prioriteFocus', IntegerType::class, array('attr' => array(
//                'min' => 1,
//                'max' => 10,
//            )))
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
            'data_class' => 'RCLAB\WebsiteBundle\Entity\News'
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rclab_websitebundle_news';
    }
}
