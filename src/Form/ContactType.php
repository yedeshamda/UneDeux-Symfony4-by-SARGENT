<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
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
                'attr' => ['class' => 'input-contact',
                    'placeholder' => '*Nom'],
                'translation_domain' => 'messages'
            ])
            ->add('prenom',null, [
                'attr' => ['class' => 'input-contact',
                    'placeholder' => '*Prenom'],
                'translation_domain' => 'messages'
            ])
            ->add('tel',TelType::class, [
                'attr' => ['class' => 'input-contact',
                    'placeholder' => '*Entrez votre numéro de téléphone'],
                'translation_domain' => 'messages'
            ])
            ->add('email',null, [
                'attr' => ['class' => 'input-contact',
                    'placeholder' => '*Entrez votre E-mail'],
                'translation_domain' => 'messages'
            ])
            ->add('message',TextareaType::class, [
                'attr' => ['class' => 'input-contact-textareaType',
                    'placeholder' => '*Entrez un message'],
                'translation_domain' => 'messages'
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
