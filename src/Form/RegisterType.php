<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe',
                'hash_property_path' => 'password',
                'mapped' => false,
                'constraints' => User::getPasswordConstraints(),
            ])
            ->add('pictureFile', FileType::class, [
                'label' => 'Avatar',
                'mapped' => false,
                'constraints' => User::getPictureConstraints(),
            ])
            ->add('acceptTerms', CheckboxType::class, [
                'label' => 'J\'accepte les conditions du service',
                'mapped' => false,
                'constraints' => [
                    new IsTrue(message: 'Vous devez accepter nos conditions !'),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}
