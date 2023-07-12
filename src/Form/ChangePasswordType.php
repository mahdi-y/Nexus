<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options' => [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Mot de passe actuel',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ],
            'second_options' => [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Confirmation du mot de passe',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ]
            ],
            'invalid_message' => 'Les mots de passe ne correspondent pas.'
        ])
        ->add('newPassword', PasswordType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Nouveau mot de passe',
            'label_attr' => ['class' => 'form-label mt-4'],
            
        ])
        ;
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}