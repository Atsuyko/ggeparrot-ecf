<?php

namespace App\Controller\Admin;

use App\Entity\Opinion;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OpinionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Opinion::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Avis')
            ->setEntityLabelInSingular('Avis')
            ->setPageTitle('index', 'Garage V.PARROT - Gestion des Avis');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-comment')->setLabel('Nouvel avis');
            })
            ->disable(Action::EDIT)
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon('fa fa-eye')->setLabel('Détail');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('Supprimer');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom'),
            IntegerField::new('score', 'Note'),
            TextareaField::new('opinion', 'Avis'),
            BooleanField::new('is_validate', 'Validé')
        ];
    }
}
