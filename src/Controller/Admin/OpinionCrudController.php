<?php

namespace App\Controller\Admin;

use App\Entity\Opinion;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
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
