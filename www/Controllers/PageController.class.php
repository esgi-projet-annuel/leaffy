<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Page;

class PageController extends AbstractController {

    public function showAll():void{
        $view = new View("pages", "back");
    }

    public function showOne():void{
        $view = new View("setPage", "back");
    }

    public function createPage():void {
        $this->checkAdmin();
        $page= new Page();
        $view = new View('setPage', 'back');
    }

    public function savePage():void{
        $this->checkAdmin();
        $page= new Page();
        // faire l'appel du formulaire

        //Est ce qu'il y a des données dans POST ou GET($form["config"]["method"])
//        $method = strtoupper($form["config"]["method"]);
//        $data = $GLOBALS["_".$method];

        $data = $_POST; //TODO a supprimer et décommenter ligne de dessus
        if(!empty($data) ){

            $page->setTitle($data['title']);
            $page->setDescription($data['description']);
            $page->setStatus($data["status"]);
            $page->setMenuId(intval($data['menuId']));
            $page->save();
        }
//        $view = new View("pages", "back");
    }

    public function updatePage():void {
        $pageId = intval($_POST['id']);
        $page = new Page();
        $page->findById($pageId);
        $data = $_POST;
        if(!empty($data) ){
            $page->setTitle($data['title']);
            $page->setDescription($data['description']);
            $page->setStatus($data["status"]);
            $page->setMenuId(intval($data['menuId']));
            // TODO comment gerer les images/photos??

            $page->save();
        }
    }

    public function deletePage():void {
        $pageId = intval($_POST['id']);
        $page = new Page();
        $page->findById($pageId);
        $page->delete();
    }

    public function getAllPages(): array {
        $page = new Page();
        $pages = $page->findAllBy(['status' => 'PUBLISHED']);
        return $pages;
    }

    //TODO:Une page contient un article! si on veut visualiser/modifier une page,
    // faire appel a l'artcile concerner via ArticleController
    //TODO corriger les routes en fonction

}