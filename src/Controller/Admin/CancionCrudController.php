<?php
namespace App\Controller\Admin;

use App\Entity\Cancion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CancionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cancion::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Titulo'),
            TextField::new('Artista'),
            TextField::new('Album'),


            ImageField::new('archivo', 'Archivo')
                ->setUploadDir('public/uploads/canciones')
                ->setBasePath('/uploads/canciones')
                ->setRequired(false),
   

                ImageField::new('imagen', 'Imagen')
                ->setUploadDir('public/uploads/images')
                ->setBasePath('/uploads/images')
                ->setRequired(false),
        ];
    }
}
