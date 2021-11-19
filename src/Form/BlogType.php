<?php

namespace App\Form;

use App\Entity\Blog;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description',CKEditorType::class, [
                'label' => false
            ])
            ->add('imageFile',VichImageType::class, [
                'required' => false,
                'allow_delete' => false,
                'delete_label' => 'Supprimer',
                'download_label' => '...',
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
                'label' => 'Image'
            ])
            ->add('descriptionEnglish',CKEditorType::class, [
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
