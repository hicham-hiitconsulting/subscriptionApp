<?php

namespace App\Controller\Admin;

use App\Entity\PaymentDetails;
use App\Entity\Service;
use App\Entity\Subscription;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Faker\Provider\ar_SA\Payment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\Admin
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        $url = $routeBuilder->setController(UserCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    /**
     * @return Dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Panel')
            ;

    }

    /**
     * @return iterable
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Subscriptions', 'fas fa-dollar-sign', Subscription::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-home', Service::class);
        yield MenuItem::linkToCrud('Payments', 'fas fa-credit-card', PaymentDetails::class);
        yield  MenuItem::linkToLogout('Logout', 'fa fa-sign-out');
    }
}
