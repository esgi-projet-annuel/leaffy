<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;
use LeaffyMvc\Services\AuthenticationService;
use LeaffyMvc\Core\View;

abstract class AbstractController{

    protected function checkAdmin(): void {
        if(!AuthenticationService::instance()->isAdmin()) {
            $view = new View("404", "errors");
        }
    }
}