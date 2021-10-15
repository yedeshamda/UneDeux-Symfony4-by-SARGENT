<?php

namespace App\Form;

use App\Entity\UserPhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

use Vich\UploaderBundle\Form\Type\VichImageType;

class UserPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('photoFile', VichImageType::class, [
            'required' => false,
            'allow_delete' => false,
            //   'imagine_pattern' => 'squared_thumbnail',
            'label' => false,
            'download_label' => false,
            'image_uri' => false,
            'download_uri' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserPhoto::class,
        ]);
    }
}