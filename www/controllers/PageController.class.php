<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Page;

class PageController extends AbstractController {

    public function showAll():void{
        $view = new View("pages", "back");
    }

    public function createPage():void{
        $view = new View("setPage", "back");
        $page = new Page();
        $form = $page->getPageForm();
        $view->assign("formPage", $form);
    }

    public function savePage():void{

        $this->checkAdmin();
        $page= new Page();
        $form = $page->getPageForm();

        //Est ce qu'il y a des données dans POST ou GET($form["config"]["method"])
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if(!empty($data) ){
            $page->setTitle($data['title']);
            $page->setDescription($data['description']);
            $page->setStatus('DRAFT');
            $page->setType('STATIC');
            $page->setContent($data['content']);
//            $page->setMenuId(intval($data['menuId']));
            $page->save();
        }
        $view = new View("pages", "back");
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
        $pages = $page->findAllBy(['type' => 'STATIC']);
        return $pages;
    }

    //TODO:Une page contient un article! si on veut visualiser/modifier une page,
    // faire appel a l'artcile concerner via ArticleController
    //TODO corriger les routes en fonction

}