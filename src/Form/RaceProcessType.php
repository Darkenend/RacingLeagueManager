<?php

namespace App\Form;

use Symfony\Component\Form\{AbstractType, FormBuilderInterface};
use App\Entity\Race;
use Symfony\Component\Form\Extension\Core\Type\{SubmitType, TextType};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RaceProcessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('raceid', EntityType::class, [
                'class' => Race::class,
                'choice_label' => 'raceinfo',
                'label' => 'Race: '
            ])
            ->add('resultfile', TextType::class, [
                'label'=>'Copy and Paste JSON here'
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
