<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('port', NumberType::class, [
                'attr' => ['min' => '9200', 'max' => '9300', 'step' => '1', 'placeholder' => '9201'],
                'label' => 'UDP/TCP Port: '
            ])
            ->add('maxConnections', NumberType::class, [
                'attr' => ['min' => '10', 'max' => '90', 'step' => '1', 'placeholder' => '60'],
                'label' => 'Max Connections: '
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
