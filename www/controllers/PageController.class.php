<?php

declare(strict_types = 1);

class PageController {

    public function showAll():void{
        $view = new View("pages", "back");
    }

    //TODO: Pas de showOne: une page contient un article! si on veut visualiser/modifier une page,
    // faire appel a l'artcile concerner via ArticleController
    //TODO : Supprimer/renommer/ajouter les views correspondantes
    //TODO corriger les routes en fonction

}