<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
                   
                ],
            ])
            ->add('idU', EntityType::class,[
                'class' => Utilisateur::class,
                'choice_label' => 'username',
                'data' => $options['user'],
                
            ]);
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
            'user' => null,
        ]);
    }
}
