<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Services')
            ->setEntityLabelInSingular('Service')
            ->setPageTitle('index', 'Garage V.PARROT - Gestion des Services');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-clipboard')->setLabel('Nouveau service');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->setLabel('Modifier');
            })
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
            TextField::new('title', 'Titre'),
            TextareaField::new('description', 'Description'),
        ];
    }
}
