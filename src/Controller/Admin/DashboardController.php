<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use App\Entity\Cancion;
use App\Entity\Playlist;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

    $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

    if ('admin@admin.com' === $this->getUser()->getEmail()) {
        return $this->redirect($adminUrlGenerator->setController(UsuarioCrudController::class)->generateUrl());
    }

    return $this->redirect($adminUrlGenerator->setController(UsuarioCrudController::class)->generateUrl());
        

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CRUD Example');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home', 'homepage');
        yield MenuItem::linkToCrud('Usuario', 'fas fa-user', Usuario::class);
        yield MenuItem::linkToCrud('Cancion', 'fas fa-user', Cancion::class);
        yield MenuItem::linkToCrud('Playlist', 'fas fa-user', Playlist::class);
    }
}
