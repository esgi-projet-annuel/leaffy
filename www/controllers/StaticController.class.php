<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Page;
use LeaffyMvc\Models\User;

class StaticController extends AbstractController {

    public function showFrontPage():void {
        if (!$_GET){
            $view = new View('home', "front");
        }else{
            $page = new Page();
            $page->findOneObjectBy(['id'=>$_GET['page']]);
            $view = new View($page->getTitle(), "front");
        }
    }

    public function showBackPage():void {
        if (!$_GET){
            $view = new View('home', "back");
        }else{
            $page = new Page();
            $page->findOneObjectBy(['id'=>$_GET['page']]);
            $view = new View($page->getTitle(), "back");
        }
    }

    public function showSettingsPage(){
        $user = new User();
        $form = $user->getRegisterForm();
        $view = new View('settings', "back");
        $view->assign("form", $form);
    }
}