<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Question::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titreQ', 'Titre'),
            TextEditorField::new('contenuQ', 'Contenu'),
            TextField::new('typeQ', 'Type'),
            DateField::new('dateAjoutQ', 'Date Ajout'),
            IntegerField::new('voteQ', 'Nombre de votes'),
            IntegerField::new('signaleQ', 'Nombre de signalisation'),
            AssociationField::new('idU', 'de la part de')->autocomplete()->formatValue(function ($value, $entity) {
                // Assuming the `Utilisateur` entity has a `getNomU()` method
                return $entity->getIdU()->getPrenomU();
            }),
        ];
    }
}
