<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            //->add('roles')
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
            ])
            ->add('nom')
            ->add('prenom')
            ->add('photo', UserPhotoType::class, [
                'required' => false,
                'label' => 'Image'
            ])
            ->add('Commandes', EntityType::class, [
                'class' => Commandes::class,
                'choice_label' => 'id',
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
