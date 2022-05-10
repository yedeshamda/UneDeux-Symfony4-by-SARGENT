<?php

namespace App\Form;

use App\Entity\Reclamation;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sujetrec')
            ->add('libelleproduit', EntityType::class, [
                'class'=>Produit::class,
                'label'=>'libelle'])
            ->add('descriptionrec')
            ->add('imgrec', FileType::class,array('data_class' => null,'required' => false), ['label' => true,] )

            ->add('daterec')
            ->add('nomprenomuser')
            ->add('emailuser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
