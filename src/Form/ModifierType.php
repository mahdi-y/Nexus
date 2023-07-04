<?php

namespace App\Form;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;





class ModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
        ->add('emailU', EmailType::class, [
            'label' => 'Email',
        ])
        ->add('NomU', TextType::class, [
            'label' => 'Nom',
        ])

        ->add('prenomU', TextType::class, [
            'label' => 'prenom',
        ])
        ->add('DateNaissanceU', DateType::class, [
            'widget' => 'single_text',
            'label' => 'Date de naissance',
            'empty_data' => 'Date de naissance',
            'attr' => [
                'class' => 'form-control flatpickr-input',
                'data-toggle' => 'flatpickr',
            ],
            'constraints' => [
                new NotBlank(['message' => 'Veuillez remplir tous les champs !']),
                new NotNull(['message' => 'Veuillez saisir une date de naissance.']),
            ],
        ])
        ->add('sexeU', ChoiceType::class, [
            'choices' => [
                'Male' => 'Male',
                'Female' => 'Female',
                'Other' => 'Other',
                 
              
            ],
            'label' => 'Sexe',

            'placeholder' => 'Choose your gender',
            'constraints' => [
                new NotBlank([
                    'message' => 'Please choose your gender',
                ]),
            ],
        ])
        ->add('Modifier', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
       
      
            'data_class' => Utilisateur::class,
    
        ]);
    }
}
