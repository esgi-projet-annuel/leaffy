<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Page;

class PageController extends AbstractController {

    public function showFrontPage():void {
        if (!$_GET || $_GET['page']== 1){
            $view = new View('home', "front");
        }else{
            $page = new Page();
            $page->findOneObjectBy(['id'=>$_GET['page']]);
            if ($page->type == 'STATIC'){
                $view = new View('pageTemplate', "front");
                $view->assign('page', $page);
            }elseif ($page->type == 'BLOG'){
                $view = new View('blogTemplate', "front");
                $view->assign('page', $page);
            }

        }
    }

    public function showHomeBack():void {
        $view = new View('home', "back");
    }

    public function createPage():void{
        $view = new View("setPage", "back");
        $page = new Page();
        $form = $page->getPageForm();
        $view->assign("formPage", $form);
    }

    public function getUpdateFormView():void {
        $view = new View("setPage", "back");
        $page = new Page();
        $form = $page->getUpdateForm($_GET['id']);
        $view->assign("formPage", $form);
    }

    public function savePage():void{

//        $this->checkAdmin();
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
        $this->getAllPagesByStatus();
    }

    public function updatePage():void {
        $pageId = intval($_POST['id']);
        $page = new Page();
        $page->findById($pageId);
        $data = $_POST;
        if(!empty($data) ){
            $page->setTitle($data['title']);
            $page->setDescription($data['description']);
            $page->setContent($data['content']);
            $page->setStatus('DRAFT');
            $page->save();
        }
        $this->getAllPagesByStatus();
    }

    public function deletePage():void {
        $pageId = intval($_POST['id']);
        $page = new Page();
        $page->findById($pageId);
        $page->delete();
    }

    public function getAllPagesByStatus():void {
        //$this->checkAdmin();
        $status = isset($_GET['status'])?$_GET['status']:'DRAFT';
        $page = new Page();
        $pages = $page->findAllBy(['status'=>$status]);
        $view = new View("pages", "back");
        $view->assign("pages", $pages);
    }

    public function changeStatus(){
        $this->checkAdmin();
        $data = $_POST;
        if(!empty($data) ){
            $pageId = intval($_POST['id']);
            $page = new Page();
            $page->findById($pageId);
            $page->setStatus($_POST['status']);
            $page->save();
        }
    }
}