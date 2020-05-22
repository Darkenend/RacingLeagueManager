<?php

namespace App\Form;

use App\Entity\Championship;
use App\Entity\Race;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('track', ChoiceType::class, [
                'choices' => [
                    '2018 Tracks' => [
                        'Monza' => 'monza',
                        'Zolder' => 'zolder',
                        'Brands Hatch' => 'brands_hatch',
                        'Silverstone' => 'silverstone',
                        'Paul Ricard' => 'paul_ricard',
                        'Misano' => 'misano',
                        'Spa' => 'spa',
                        'Nürburgring' => 'nurburgring',
                        'Barcelona' => 'barcelona',
                        'Hungaroring' => 'hungaroring',
                        'Zandvoort' => 'zandvoort'
                    ],
                    '2019 Tracks' => [
                        'Monza' => 'monza_2019',
                        'Zolder' => 'zolder_2019',
                        'Brands Hatch' => 'brands_hatch_2019',
                        'Silverstone' => 'silverstone_2019',
                        'Paul Ricard' => 'paul_ricard_2019',
                        'Misano' => 'misano_2019',
                        'Spa' => 'spa_2019',
                        'Nürburgring' => 'nurburgring_2019',
                        'Barcelona' => 'barcelona_2019',
                        'Hungaroring' => 'hungaroring_2019',
                        'Zandvoort' => 'zandvoort_2019'
                    ],
                    'IGTC Tracks' => [
                        'Kyalami' => 'kyalami_2019',
                        'Mount Panorama' => 'mount_panorama_2019',
                        'Suzuka' => 'suzuka_2019',
                        'Laguna Seca' => 'laguna_seca_2019'
                    ]
                ],
                'label' => 'Track: '
            ])
            ->add('championship_id', EntityType::class, [
                'class'=>Championship::class,
                'choice_label'=>'name',
                'label' => 'Championship: '
            ])
            ->add('ambientTemp', NumberType::class, [
                'attr' => ['min' => '-10', 'step' => '0.5', 'max' => '45', 'placeholder' => '25'],
                'label' => 'Ambient Temp: '
            ])
            ->add('cloudLevel', NumberType::class, [
                'attr' => ['min' => '0', 'step' => '0.01', 'max' => '1', 'placeholder' => '0.3'],
                'label' => 'Cloud Level %: '
            ])
            ->add('rain', NumberType::class, [
                'attr' => ['min' => '0', 'step' => '0.01', 'max' => '1', 'placeholder' => '0'],
                'label' => 'Rain Chance %: '
            ])
            ->add('practice_hour', NumberType::class, [
                'attr' => ['min' => '0', 'step' => '1', 'max' => '23', 'placeholder' => '9'],
                'label' => 'Practice Session Start Hour: '
            ])
            ->add('practice_length', NumberType::class, [
                'attr' => ['min' => '5', 'step' => '1', 'max' => '120', 'placeholder' => '10'],
                'label' => 'Practice Session Length (minutes): '
            ])
            ->add('qualy_hour', NumberType::class, [
                'attr' => ['min' => '0', 'step' => '1', 'max' => '23', 'placeholder' => '12'],
                'label' => 'Qualifying Session Start Hour: '
            ])
            ->add('qualy_length', NumberType::class, [
                'attr' => ['min' => '5', 'step' => '1', 'max' => '60', 'placeholder' => '10'],
                'label' => 'Qualifying Session Length (minutes): '
            ])
            ->add('race_hour', NumberType::class, [
                'attr' => ['min' => '0', 'step' => '1', 'max' => '23', 'placeholder' => '14'],
                'label' => 'Race Session Start Hour: '
            ])
            ->add('race_length', NumberType::class, [
                'attr' => ['min' => '5', 'step' => '1', 'max' => '1440', 'placeholder' => '10'],
                'label' => 'Race Session Length (minutes): '
            ])
            ->add('greenflagtime', DateTimeType::class, [
                'label' => 'Race Start Date & Time (UTC)',
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Race::class,
        ]);
    }
}
