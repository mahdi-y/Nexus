<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UtilisateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomU', 'Nom'),
            TextField::new('prenomU', 'Prenom'),
            EmailField::new('emailU', 'Adresse Email'),
            DateField::new('dateNaissanceU', 'Date de naissance'),
            ChoiceField::new('sexeU', 'Sexe')
                ->setChoices([
                    'homme' => 'homme',
                    'femme' => 'femme',
                ])
                ->allowMultipleChoices(false),
            IntegerField::new('verifieU', 'Utilisateur verifié'),
            CollectionField::new('roles', 'Roles')->formatValue(function ($value, $entity) {
                // Customize the display of roles
                if ($entity instanceof Utilisateur) {
                    return implode(', ', $entity->getRoles());
                }
                return $value;
            }),
            IntegerField::new('actifU', 'Actif'),

        ];
    }
}
