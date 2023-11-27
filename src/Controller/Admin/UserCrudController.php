<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(public UserPasswordHasherInterface $hasher)
    {
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur')
            ->setPageTitle('index', 'Garage V.PARROT - Gestion des Utilisateurs');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('email', 'Email'),
            TextField::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom'),
            TextField::new('password', 'Mot de passe')
                ->setFormType(PasswordType::class)
                ->onlyOnForms(),
            ArrayField::new('roles', 'Role')
                ->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $user = $entityInstance;
        $plainPassword = $user->getPassword();
        $hashedPassword = $this->hasher->hashPassword($user, $plainPassword);

        $user->setPassword($hashedPassword);
        parent::persistEntity($entityManager, $entityInstance);
    }
}
