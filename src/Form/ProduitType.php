<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description',TextareaType::class)
            ->add('descriptiontech',CKEditorType::class, [
                'label' => 'Description Technique',
            ])
            ->add('categorie')
            ->add('marque')
//            ->add('devis')
            ->add('fichetech',null, [
                'label' => 'Fiche Technique',
            ])
            ->add('imageFile',VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer',
                'download_label' => '...',
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
                'label' => 'Image de couverture',
//                'label_attr' => array('class' => 'form-label')
            ])
            ->add('image')
            ->add('featured',CheckboxType::class, [
                'required' => false,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
