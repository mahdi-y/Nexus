<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;




class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreQ', TextType::class)
            ->add('contenuQ', TextType::class)
            ->add('typeQ', ChoiceType::class, [
                'placeholder' => 'Select an option',
                'choices' => [
                    'Bug' => 'Bug',
                    'Error' => 'Error',
                    // Add more options if needed
                ],
            ])
            ->add('idU', EntityType::class, [
                'class' => 'App\Entity\Utilisateur',
                'choice_label' => 'username',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
