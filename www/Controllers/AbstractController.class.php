<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;
use LeaffyMvc\Services\AuthenticationService;
use LeaffyMvc\Core\View;

class AbstractController{

    protected function checkAdmin(): void {
        if(!AuthenticationService::instance()->isAdmin()) {
            $view = new View("401", "errors");
        }
    }

    protected function checkEditor(): void {
        if(!AuthenticationService::instance()->isEditor()) {
            $view = new View("401", "errors");
        }
    }

    protected function checkAdminOrEditor(): void {
        $this->checkAdmin();
        $this->checkEditor();
    }
}
