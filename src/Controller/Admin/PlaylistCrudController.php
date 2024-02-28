<?php
namespace App\Controller\Admin;

use App\Entity\Playlist;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlaylistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Playlist::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('id_usuario'),
            TextField::new('Nombre'),
            


                ImageField::new('imagen', 'Imagen')
                ->setUploadDir('public/uploads/images')
                ->setBasePath('/uploads/images')
                ->setRequired(false),
        ];
    }
}
