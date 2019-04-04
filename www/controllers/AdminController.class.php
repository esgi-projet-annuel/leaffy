<?php

declare(strict_types = 1);

class AdminController {

    public function showHomeAdmin(): void{
        $view = new View('home', 'back');
    }

}