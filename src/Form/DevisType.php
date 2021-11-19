<?php

namespace App\Form;

use App\Entity\Devis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',null, ['translation_domain' => 'messages'])
            ->add('prenom',null, ['translation_domain' => 'messages'])
            ->add('tel',null, ['translation_domain' => 'messages'])
            ->add('email',null, ['translation_domain' => 'messages'])
            ->add('message',TextareaType::class, ['translation_domain' => 'messages'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
