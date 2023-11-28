<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Annonces')
            ->setEntityLabelInSingular('Annonce')
            ->setPageTitle('index', 'Garage V.PARROT - Gestion des Annonces');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Action::NEW)
            ->disable(Action::EDIT)
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon('fa fa-eye')->setLabel('Détail');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('Supprimer');
            });
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
