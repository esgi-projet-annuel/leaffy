<?php

declare(strict_types = 1);

class ArticleController {

    public function showAll() :void{
        $view = new View("articles", "back");
    }

    public function showOne():void{
        $view = new View("setArticle", "back");
        $post = new Post();
        $form = $post->getPostForm();
        $view->assign("formPost", $form);
    }

    //TODO : showAll uniquement pour lister les articles de blog => showAllBlogArticles()
    //TODO : showOne pour afficher/modifier une page (pour rappel, le contenu d'une page
    //est en fait un article dans la BDD) ou modifier/afficher un article de blog
    //TODO : Supprimer/renommer les views correspondantes
    //TODO corriger les routes en fonction
}
