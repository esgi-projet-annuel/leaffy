<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;
use LeaffyMvc\Core\View;

class AdminController extends AbstractController {

    public function showHomeAdmin(): void{
        $view = new View('home', 'back');
    }

}