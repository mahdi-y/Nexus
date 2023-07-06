<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurCrudController extends AbstractCrudController
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomU', 'Nom'),
            TextField::new('prenomU', 'Prenom'),
            TextField::new('mdp', 'mdp')->hideOnIndex()->hideWhenUpdating()->hideOnForm(),
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

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    // UtilisateurCrudController.php

    // ...

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Utilisateur) {
            // Check if the plain password is not null
            $plainPassword = $entityInstance->getPlainPassword();
            if ($plainPassword !== null) {
                // Encode the password before persisting the user
                $encodedPassword = $this->passwordEncoder->encodePassword($entityInstance, $plainPassword);
                $entityInstance->setMdp($encodedPassword);
            } else {
                // If the plain password is null, set a default password or handle the scenario accordingly
                $defaultPassword = 'aziz';
                $encodedPassword = $this->passwordEncoder->encodePassword($entityInstance, $defaultPassword);
                $entityInstance->setMdp($encodedPassword);
            }
        }

        parent::persistEntity($entityManager, $entityInstance);
    }
}
