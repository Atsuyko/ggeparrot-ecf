<?php

namespace App\Controller\Admin;

use App\Entity\OpeningTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
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
