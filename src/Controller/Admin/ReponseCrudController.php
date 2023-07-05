<?php

namespace App\Controller\Admin;

use App\Entity\Reponse;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReponseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reponse::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('contenuR', 'Contenu'),
            DateField::new('dateAjoutR', 'Date Ajout'),
            IntegerField::new('voteR', 'Nombre de votes'),
            IntegerField::new('etatR', 'Etat'),
            IntegerField::new('signaleR', 'Nombre de signalisation'),
            AssociationField::new('idQ', 'Reponse a la question')->autocomplete()->formatValue(function ($value, $entity) {

                return $entity->getIdQ()->getTitreQ();
            }),
            AssociationField::new('idU', 'de la part de')->autocomplete()->formatValue(function ($value, $entity) {
                // Assuming the `Utilisateur` entity has a `getNomU()` method
                return $entity->getIdU()->getPrenomU();
            }),
        ];
    }
}
