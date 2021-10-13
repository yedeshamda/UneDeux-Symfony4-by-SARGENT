<?php

namespace App\Form;

use App\Entity\Parametre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParametreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tel1',null,[
                'label' => 'Numéro Télèphone 1',
            ])
            ->add('tel2',null,[
                'label' => 'Numéro Télèphone 2',
            ])
            ->add('email',null,[
                'label' => 'E-mail',
            ])
            ->add('fb',null,[
                'label' => 'FACEBOOK',
            ])
            ->add('youtube',null,[
                'label' => 'YOUTUBE',
            ])
            ->add('linkedin',null,[
                'label' => 'LINKEDIN',
            ])
            ->add('instagram',null,[
                'label' => 'INSTAGRAM',
            ])
            ->add('adresse')
            ->add('ville')
            ->add('jourdebut',null,[
                'label' => 'De',
            ])
            ->add('Jusqu a')
            ->add('heuredebut')
            ->add('heurefin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parametre::class,
        ]);
    }
}
