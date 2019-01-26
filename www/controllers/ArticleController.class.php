<?php

class ArticleController {

    public function showAll(){
        $view = new View("articles", "back");
    }

    public function showOne(){
        $view = new View("setArticle", "back");
    }
}