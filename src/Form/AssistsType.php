<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssistsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('stabilityControlLevelMax', RangeType::class, [
                'attr' => [
                    'min' => '0',
                    'max' => '100'
                ],
                'label' => 'Stability Control %'
            ])
            ->add('disableAutosteer', CheckboxType::class, [
                'required' => false,
                'label' => 'Autosteer'
            ])
            ->add('disableAutoLights', CheckboxType::class, [
                'required' => false,
                'label' => 'Auto Lights'
            ])
            ->add('disableAutoWiper', CheckboxType::class, [
                'required' => false,
                'label' => 'Auto Wiper'
            ])
            ->add('disableAutoEngineStart', CheckboxType::class, [
                'required' => false,
                'label' => 'Auto Engine Start'
            ])
            ->add('disableAutoPitLimiter', CheckboxType::class, [
                'required' => false,
                'label' => 'Auto Pit Limiter'
            ])
            ->add('disableAutoGear', CheckboxType::class, [
                'required' => false,
                'label' => 'Auto Gear Shifts'
            ])
            ->add('disableAutoClutch', CheckboxType::class, [
                'required' => false,
                'label' => 'Auto Clutch'
            ])
            ->add('disableIdealLine', CheckboxType::class, [
                'required' => false,
                'label' => 'Ideal Driving Line'
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
