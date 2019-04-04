<?php

declare(strict_types = 1);

class StaticController {

    public function showFrontPage():void {
        $page = new Page();
        $page->findOneObjectBy(['id'=>$_GET['page']]);
        $view = new View($page->getTitle(), "front");
    }

    public function showBackPage():void {
        $view = new View($_GET['page'], "back");
    }
}