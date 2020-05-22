<?php

namespace App\Form;

use App\Entity\Championship;
use App\Entity\ChampionshipEntries;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChampionshipSignupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $teamid = $options['customdata'];
        $builder
            ->add('championship', EntityType::class, [
                'class' => Championship::class,
                'choice_label' => 'name'
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ChampionshipEntries::class,
            'customdata' => null
        ]);
    }
}
