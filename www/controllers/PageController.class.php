<?php

class PageController {

    public function showAll(){
        $view = new View("pages", "back");
    }

    public function showOne(){
        $view = new View("setPage", "back");
    }

}