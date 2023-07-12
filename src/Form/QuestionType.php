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
use Symfony\Component\Security\Core\Security;

class QuestionType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];
        $builder
            ->add('titreQ', TextType::class)
            ->add('contenuQ', TextType::class)
            ->add('typeQ', ChoiceType::class, [
                'placeholder' => 'Select an option',
                'choices' => [
                    'Bug' => 'Bug',
                    'Error' => 'Error',
                ],
            ]);

        // Check if the user is logged in
        if ($user instanceof Utilisateur) {
            // Set the idU value for the logged-in user
            $builder->add('idU', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'username',
                'data' => $user,
                'attr' => ['style' => 'display: none;'],
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
            'user' => null,
        ]);
    }
}