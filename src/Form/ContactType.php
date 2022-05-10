<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',null, [
                'attr' => ['class' => 'app-form-control',
                    'placeholder' => '*Nom',
                    'value'=> 'Ben Foulen'],
             ])
            ->add('prenom',null, [
                'attr' => ['class' => 'app-form-control',
                    'placeholder' => '*Prenom',
                'value'=> 'Foulen'],
             ])
            ->add('tel',TelType::class, [
                'attr' => ['class' => 'app-form-control',
                    'placeholder' => '*Numéro de téléphone'],
             ])
            ->add('email',EmailType::class, [
                'attr' => ['class' => 'app-form-control',
                    'placeholder' => '*Entrez votre E-mail'],
             ])
            ->add('message',TextareaType::class, [
                'attr' => ['class' => 'app-form-control',
                    'placeholder' => '*Entrez un message'],
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
