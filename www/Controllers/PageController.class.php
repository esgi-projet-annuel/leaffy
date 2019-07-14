<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\SitemapGenerator;
use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Page;
use LeaffyMvc\Models\Post;
use LeaffyMvc\Core\Validator;

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
                $post= new Post();
                $posts = $post->findAllBy(['status'=>'PUBLISHED']);
                $view = new View('blogTemplate', "front");
                $view->assign('posts', $posts);
            }
        }
    }

    public function showHomeBack():void {
        $view = new View('home', "back");
    }

    public function createPage():void{
        $this->checkAdmin();
        $view = new View("setPage", "back");
        $page = new Page();
        $form = $page->getPageForm();
        $view->assign("formPage", $form);
    }

    public function getUpdateFormView():void {
        $this->checkAdmin();
        $view = new View("setPage", "back");
        $page = new Page();
        $form = $page->getUpdateForm($_GET['id']);
        $view->assign("formPage", $form);
    }

    public function savePage():void{
        $this->checkAdmin();
        $page= new Page();
        $form = $page->getPageForm();

        //Est ce qu'il y a des données dans POST ou GET($form["config"]["method"])
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {
            $validator = new Validator($form, $data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){
                $page->setTitle($data['title']);
                $page->setDescription($data['description']);
                $page->setStatus('DRAFT');
                $page->setType('STATIC');
                $page->setContent($data['content']);
                $page->setMenuPosition(0);
                $page->save();
                SitemapGenerator::generate();
                $this->getAllPagesByStatus();
            }else{
                $view = new View('setPage', 'back');
                $view->assign('formPage', $form);
            }
        }

    }

    public function updatePage():void {
        $this->checkAdmin();
        $page = new Page();
        $form = $page->getUpdateForm($_POST['id']);

        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {
            $validator = new Validator($form, $data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){
                $pageId = intval($data['id']);
                $page->findById($pageId);
                $page->setTitle($data['title']);
                $page->setDescription($data['description']);
                $page->setContent($data['content']);
                $page->setStatus('DRAFT');
                $page->save();
                SitemapGenerator::generate();
                $this->getAllPagesByStatus();
            }else{
                $view = new View('setPage', 'back');
                $view->assign('formPage', $form);
            }
        }
    }

    public function deletePage():void {
        $this->checkAdmin();
        $pageId = intval($_POST['id']);
        $page = new Page();
        $page->findById($pageId);
        $page->delete();
        SitemapGenerator::generate();
    }

    public function getAllPagesByStatus():void {
        $this->checkAdmin();
        //$this->checkAdmin();
        $status = isset($_GET['status'])?$_GET['status']:'DRAFT';
        $page = new Page();
        $pages = $page->findAllBy(['status'=>$status]);
        $view = new View("pages", "back");
        $view->assign("pages", $pages);
    }

    public function changeStatus():void{
        $this->checkAdmin();
        $data = $_POST;
        if(!empty($data) ){
            $pageId = intval($_POST['id']);
            $page = new Page();
            $page->findById($pageId);
            $page->setStatus($_POST['status']);

            if($_POST['status'] == 'PUBLISHED') {
                $page->setInitialMenuPosition();
            }
            $page->save();
            SitemapGenerator::generate();
        }
    }

    public function changeMenuPosition():void {
        $this->checkAdmin();
        $this->checkAdmin();
        $data = $_POST;
        if(!empty($data) ){
            $pageId = intval($_POST['id']);
            $page = new Page();
            $page->findById($pageId);
            $page->setMenuPosition(intval($_POST['menu_position']));
            $page->save();
        }
    }

}
