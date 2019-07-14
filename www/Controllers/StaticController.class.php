<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Page;
use LeaffyMvc\Models\User;

class StaticController extends AbstractController {

    public function showValidationView(){
        $view = new View('validation', 'front');
    }
}