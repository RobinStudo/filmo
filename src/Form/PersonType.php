<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', null, [
                'label' => 'Prénom',
            ])
            ->add('lastname', null, [
                'label' => 'Nom',
            ])
            ->add('birthdate', null, [
                'label' => 'Date de naissance',
                'widget' => 'single_text'
            ])
            ->add('nationality', CountryType::class, [
                'label' => 'Nationalité',
                'preferred_choices' => ['FR', 'GB', 'US']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}
