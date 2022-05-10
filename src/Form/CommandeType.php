<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\Produit;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Client', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'nom',

            ])
            ->add('Produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom',

            ])
            ->add('prixCommande')
            ->add('adresseClient')
            ->add('quantite');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
    public function __toString()
    {
        return $this->name;
    }
}
