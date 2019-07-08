<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Post;

class PostController extends AbstractController {

    public function showAll() :void{
        $view = new View("posts", "back");
    }

    public function showOnePost() :void{
        $postModel= new Post();
        $post = $postModel->findById(intval($_GET['id']));
        $view = new View("ShowOnePost", "front");
        $view->assign('post', $post);
    }

    public function createPost():void{
        $view = new View("setPost", "back");
        $post = new Post();
        $form = $post->getPostForm();
        $view->assign("formPost", $form);
    }

    public function getUpdateFormView():void{
        $view  =  new View('setPost', 'back');
        $post = new Post();
        $form= $post->getUpdateForm($_GET['id']);
        $view->assign("formPost", $form);
    }

    public function savePost():void{
        $post = new Post();
        $form = $post->getPostForm();

        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if(!empty($data) ){

            $post->setTitle($data['title']);
            $post->setDescription($data['description']);
            $post->setContent($data['content']);
            $post->setStatus('DRAFT');
            $post->setPageId(3);
            $post->save();
        }
        $this->getAllPostsByStatus();
    }

    public function deletePost():void {
        $postId = intval($_POST['id']);
        $post = new Post();
        $post->findById($postId);
        $post->delete();
    }

    public function updatePost():void {
        $postId = intval($_POST['id']);
        $post = new Post();
        $post->findById($postId);
        $data = $_POST;
        if(!empty($data) ){
            $post->setTitle($data['title']);
            $post->setContent($data['content']);
            $post->setDescription($data['description']);
            $post->save();
        }
        $this->getAllPostsByStatus();
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
        $posts = $post->findAllBy(['status'=>$status]);
        $view = new View("posts", "back");
        $view->assign("posts", $posts);
    }

    public function changeStatus(){
        $this->checkAdmin();
        $data = $_POST;
        if(!empty($data) ){
            $postId = intval($_POST['id']);
            $post = new Post();
            $post->findById($postId);
            $post->setStatus($_POST['status']);
            $post->save();
        }
    }

}
