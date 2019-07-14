<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Post;
use LeaffyMvc\Core\Validator;

class PostController extends AbstractController {

    public function showAll() :void {
        $view = new View("posts", "back");
    }

    public function showOnePost($errors = null) :void {
        $postModel= new Post();
        $post = $postModel->findById(intval($_GET['id']));
        $view = new View("showOnePost", "front");
        $view->assign('post', $post);
        $view->assign('errors', $errors);
    }

    public function createPost():void {
        $this->checkAdminOrEditor();
        $view = new View("setPost", "back");
        $post = new Post();
        $form = $post->getPostForm();
        $view->assign("formPost", $form);
    }

    public function getUpdateFormView():void {
        $this->checkAdminOrEditor();
        $view  =  new View('setPost', 'back');
        $post = new Post();
        $form= $post->getUpdateForm($_GET['id']);
        $view->assign("formPost", $form);
    }

    public function savePost():void {
        $this->checkAdminOrEditor();
        $post = new Post();
        $form = $post->getPostForm();

        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {
            $validator = new Validator($form, $data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){
                $post->setTitle($data['title']);
                $post->setDescription($data['description']);
                $post->setContent($data['content']);
                $post->setStatus('DRAFT');
                $post->setPageId(3);
                $post->save();
                $this->getAllPostsByStatus();
            }else{
                $view = new View("setPost", "back");
                $view->assign("formPost", $form);
            }
        }
    }

    public function updatePost():void {
        $this->checkAdminOrEditor();
        $post = new Post();
        $form= $post->getUpdateForm($_POST['id']);

        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {
            $validator = new Validator($form, $data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){
                $postId = intval($data['id']);
                $post->findById($postId);
                $post->setTitle($data['title']);
                $post->setContent($data['content']);
                $post->setDescription($data['description']);
                $post->save();
                $this->getAllPostsByStatus();
            }else{
                $view = new View("setPost", "back");
                $view->assign("formPost", $form);
            }
        }
    }

    public function deletePost():void {
        $this->checkAdminOrEditor();
        $postId = intval($_POST['id']);
        $post = new Post();
        $post->findById($postId);
        $post->delete();
    }

    public function getAllPosts(): array {
        $post = new Post();
        $posts = $post->findAllByOrder(['orderBy' => 'status']);
        return $posts;
    }

    public function getAllPostsByStatus():void {
        //$this->checkAdmin();
        $status = isset($_GET['status'])?$_GET['status']:'DRAFT';
        $post = new Post();
        $posts = $post->findAllBy(['status'=>$status],['table'=>'Category', 'field'=>'category_id','fieldWanted'=>'name']);
        $view = new View("posts", "back");
        $view->assign("posts", $posts);
    }

    public function changeStatus():void{
        $this->checkAdminOrEditor();
        $data = $_POST;
        if(!empty($data) ){
            $postId = intval($_POST['id']);
            $post = new Post();
            $post->findById($postId);
            $post->setStatus($_POST['status']);
            $post->save();
        }
    }

    public function changeCategory():void{
        $this->checkAdminOrEditor();
        $data = $_POST;
        print(intval($_POST['category']));
        if(!empty($data) ){
            $postId = intval($_POST['id']);
            $post = new Post();
            $post->findById($postId);
            $post->setCategoryId(intval($_POST['category']));
            $post->save();
        }
    }

}
