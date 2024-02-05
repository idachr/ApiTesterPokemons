<?php

require_once __DIR__ . '/config/interface.middleware.php';
require_once __DIR__ . '/../classes/dbh.classes.php';
require_once __DIR__ . '/../models/usermanager.models.php';


class Middleware_Terms implements Middleware_Interface
{
    private $path;

    public function handle($request, Closure $next)
    {
        if (!isset($_SESSION['id'])) {
            // Handle the case where $trainerId is not set (redirect or handle error)
            header("Location: ./home.views.php?error=trainernotfound");
            exit();
        }

        $userManager = new UserManagerModel();
        $trainerId = $_SESSION['id'];
        $terms_approved = $userManager->getTermsAcceptedStatus($trainerId);

        $_SESSION['terms_approved'] = $terms_approved;

        if (!$terms_approved) {
            if ($this->path !== 'views/private/terms.views.php') {
                header('Location ../views/private/terms.views.php');
            }

            return;
        }

        return $next($request);
    }
}