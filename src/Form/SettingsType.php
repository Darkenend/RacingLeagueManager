<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('serverName', TextType::class, [
                'label' => 'Server Name: '
            ])
            ->add('adminPassword', TextType::class, [
                'label' => 'Admin Password: '
            ])
            ->add('maxCarSlots', NumberType::class, [
                'attr' => ['min' => '5', 'max' => '32', 'step' => '1', 'placeholder' => '20'],
                'label' => 'Max Car Slots: '
            ])
            ->add('allowAutoDQ', CheckboxType::class, [
                'label' => 'Allow Automatic Disqualifications: ',
                'required' => false
            ])
            ->add('shortFormationLap', CheckboxType::class, [
                'label' => 'Short Formation Lap: ',
                'required' => false
            ])
            ->add('formationLapType', ChoiceType::class, [
                'choices' => [
                    'Default Formation Lap' => '3',
                    'Free Formation Lap' => '1',
                    'Limiter Formation Lap' => '0'
                ],
                'label' => "Formation Lap Type: "
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
