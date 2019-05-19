<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Post;

class PostController extends AbstractController {

    public function showAll() :void{
        $view = new View("posts", "back");
    }

    public function createPost():void{
        $view = new View("setPost", "back");
        $post = new Post();
        $form = $post->getPostForm();
        $view->assign("formPost", $form);
    }

    public function savePost():void{
        $this->checkAdmin();
        $post = new Post();
        // faire l'appel du formulaire
//        $form = $post->getRegisterForm();

        //Est ce qu'il y a des données dans POST ou GET($form["config"]["method"])
//        $method = strtoupper($form["config"]["method"]);
//        $data = $GLOBALS["_".$method];
        $data = $_POST; //TODO a supprimer et décommenter ligne de dessus
        if(!empty($data) ){

            $post->setTitle($data['title']);
            $post->setDescription($data['description']);
            $post->setContent($data['content']);
            $post->setType($data["type"]);
            $post->setStatus($data["status"]);
            $post->setPageId(intval($data['pageId']));
            // TODO comment gerer les images/photos??
            $post->save();
        }
        $view = new View("articles", "back");
    }

    public function deletePost():void {
        $postId = intval($_POST['id']);
        $post = new Post();
        $post->findById($postId);
        $post->delete();
    }

    public function publishPost(): void {
        $postId = intval($_POST['id']);
        $post = new Post();
        $post->findById($postId);
        $post->status('PUBLISHED');
        $post->save();
    }

    public function unpublishPost(): void {
        $postId = intval($_POST['id']);
        $post = new Post();
        $post->findById($postId);
        $post->status('WITHDRAWN');
        $post->save();
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
            $post->setType($data["type"]);
            $post->setStatus($data["status"]);
            $post->setPageId(intval($data['pageId']));
            // TODO comment gerer les images/photos??

            $post->save();
        }
    }

    public function getAllPosts(): array {
        $post = new Post();
        $posts = $post->findAllBy(['status' => 'PUBLISHED']);
        return $posts;
    }

    //TODO : showAll uniquement pour lister les articles de blog => showAllBlogArticles()
    //TODO : showOne pour afficher/modifier une page (pour rappel, le contenu d'une page
    //est en fait un article dans la BDD) ou modifier/afficher un article de blog
    //TODO : Supprimer/renommer les views correspondantes
    //TODO corriger les routes en fonction
}