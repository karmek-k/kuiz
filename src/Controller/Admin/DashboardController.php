<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use App\Entity\QuestionAnswer;
use App\Entity\Quiz;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Kuiz');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Quizzes', 'fas fa-list', Quiz::class);
        yield MenuItem::linkToCrud('Questions', 'fas fa-question', Question::class);
        yield MenuItem::linkToCrud('Question answers', 'fas fa-check', QuestionAnswer::class);
    }
}
