<?php

class ArticleController {

    public function showAll(){
        $view = new View("articles", "back");
    }

    public function showOne(){
        $view = new View("setArticle", "back");
    }

    //TODO : showAll uniquement pour lister les articles de blog => showAllBlogArticles()
    //TODO : showOne pour afficher/modifier une page (pour rappel, le contenu d'une page
    //est en fait un article dans la BDD) ou modifier/afficher un article de blog
    //TODO : Supprimer/renommer les views correspondantes
}