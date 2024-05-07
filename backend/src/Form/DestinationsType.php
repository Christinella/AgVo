<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Destinations;
use App\Entity\Pays;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DestinationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('image')
            ->add('prix')
           
            ->add('dateDepart', null, [
                'widget' => 'single_text',
            ])
            ->add('dateArrivee', null, [
                'widget' => 'single_text',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'nom',
            ])
            ->add('Pays', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'nom',
            ])
            ->add('Categorie', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'nom',
              
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Destinations::class,
        ]);
    }
}
