<?php

namespace App\Controller\Admin;
use App\Entity\Salle;
use App\Entity\PreReservation;
use App\Entity\Utilisateur;
use App\Entity\Ergonomie;
use App\Entity\Logiciel;
use App\Entity\Materiel;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin',  methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return parent::index('admin/admin.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        //  $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        //  return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Salle');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Prereservation', 'fas fa-list', PreReservation::class);
        yield MenuItem::linkToCrud('Salle', 'fas fa-list', Salle::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', Utilisateur::class);
        yield MenuItem::linkToCrud('Logiciel', 'fas fa-list', Logiciel::class);
        yield MenuItem::linkToCrud('Materiel', 'fas fa-list', Materiel::class);
        yield MenuItem::linkToCrud('Ergonomie', 'fas fa-list', Ergonomie::class);
    }
}
