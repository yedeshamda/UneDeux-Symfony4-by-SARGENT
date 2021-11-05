<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('baniereImageFile',VichImageType::class, [
                'required' => false,
                'allow_delete' => false,
                'delete_label' => 'Supprimer',
                'download_label' => '...',
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
                'label' => 'Image'
            ])
            ->add('titre')
            ->add('description',TextareaType::class)
            ->add('imageFile2',VichImageType::class, [
                'required' => false,
                'allow_delete' => false,
                'delete_label' => 'Supprimer',
                'download_label' => '...',
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
                'label' => 'Image PNG'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
