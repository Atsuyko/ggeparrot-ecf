<?php

namespace App\Controller\Admin;

use App\Entity\OpeningTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OpeningTimeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningTime::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Horaires')
            ->setEntityLabelInSingular('Horaire')
            ->setPageTitle('index', 'Garage V.PARROT - Gestion des Horaires');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->setLabel('Modifier');
            })
            ->disable(Action::DETAIL)
            ->disable(Action::DELETE);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('day', 'Jour de la semaine')
                ->setFormTypeOption('disabled', 'disabled'),
            TimeField::new('open_am', 'Ouverture matin')
                ->setFormat('HH:mm'),
            TimeField::new('close_am', 'Fermeture matin')
                ->setFormat('HH:mm'),
            TimeField::new('open_pm', 'Ouverture après-midi')
                ->setFormat('HH:mm'),
            TimeField::new('close_pm', 'Fermeture après-midi')
                ->setFormat('HH:mm'),
        ];
    }
}
