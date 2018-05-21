<?php

namespace RCLAB\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'rclabwebsite_bundle_upload_image_type';
    }
}
