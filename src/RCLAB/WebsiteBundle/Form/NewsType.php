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
            ])
            ->add('description', TextareaType::class)
            ->add('link', UrlType::class, [
                'label' => 'lien',
            ])
            ->add('shareDate', DateTimeType::class, [
                'label' => 'Date de publication',
            ])
            ->add('focus', CheckboxType::class, [
                'label' => 'Mettre en focus',
            ])
//            ->add('prioriteFocus', IntegerType::class, array('attr' => array(
//                'min' => 1,
//                'max' => 10,
//            )))
            ->add('image', FileType::class)
            ->add('Valider', SubmitType::class);
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
