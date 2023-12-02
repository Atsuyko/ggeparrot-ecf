<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

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
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-car')->setLabel('Nouvelle annonce');
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
            TextField::new('brand', 'Marque'),
            TextField::new('model', 'Modèle'),
            DateField::new('year', 'Année'),
            IntegerField::new('km', 'Kilométrage'),
            IntegerField::new('price', 'prix'),
            AssociationField::new('options', 'Option'),
            ImageField::new('teaserImg', 'Image Vitrine')
                ->setBasePath('uploads')
                ->setUploadDir('public/uploads'),
            ImageField::new('img1', 'Image 1')
                ->setBasePath('uploads')
                ->setUploadDir('public/uploads'),
            ImageField::new('img2', 'Image 2')
                ->setBasePath('uploads')
                ->setUploadDir('public/uploads'),
            ImageField::new('img3', 'Image 3')
                ->setBasePath('uploads')
                ->setUploadDir('public/uploads'),

        ];
    }
}
