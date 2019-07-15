<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Comment;
use LeaffyMvc\Core\Validator;
use LeaffyMvc\Models\User;
use LeaffyMvc\Services\AuthenticationService;
use LeaffyMvc\Services\MailConfirmationService;

class CommentController extends AbstractController
{
    public function getCommentForm(string $postId): array{
        $comment = new Comment();
        $form = $comment->getCommentForm($postId);
        return $form;
    }

    public function saveComment(): void {
        $comment = new Comment();
        $form = $comment->getCommentForm();
        if (AuthenticationService::isConnected()){
            $method = strtoupper($form["config"]["method"]);
            $data = $GLOBALS["_".$method];
            if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {
                $validator = new Validator($form, $data);
                $form["errors"] = $validator->errors;
                if(empty($form["errors"])){
                    $comment->setContent($data['content']);
                    $comment->setUserId(intval($_SESSION['userId']));
                    $comment->setPostId(intval($data['post_id']));
                    $comment->setStatus('PENDING');
                    $comment->save();
                    $form["errors"][] ="Votre commentaire à bien été envoyé";
                    MailConfirmationService::instance()->sendMail('Nouveau commentaire!', 'comment');

                }

                $postController = new PostController();
                $_GET['id'] = intval($data['post_id']);
                $postController->showOnePost($form["errors"]);
            }
        }else{
            die('Vous devez etre connecté pour saisir un commentaire! ');
        }
    }

    public function approveComment(): void
    {
        $data = $_POST;
        if(!empty($data) ){
            $commentId = intval($_POST['id']);
            $comment = new Comment();
            $comment->findById($commentId);
            $comment->setStatus('APPROVED');
            $comment->save();
        }
    }

    public function rejectComment(): void
    {
        $data = $_POST;
        if(!empty($data) ){
            $commentId = intval($_POST['id']);
            $comment = new Comment();
            $comment->findById($commentId);
            $comment->setStatus('REJECTED');
            $comment->save();
        }
    }

    public function listCommentsByStatus():void {
        $status = isset($_GET['status'])?$_GET['status']:'PENDING';
        $comment = new Comment();
        $comments = $comment->findAllBy(['status' => $status]);
        $user= new User();
        foreach ($comments as $comment){
            $comment->created_at = $comment->getFrDate($comment->created_at);
            $user->findById(intval($comment->user_id));
            $comment->user_id= $user->firstname .' '. $user->lastname;
        }
        $view = new View("comments", "back");
        $view->assign("comments", $comments);
    }

    public function listApprovedCommentsByPost(string $postId):array{
        $commentModel = new Comment();
        $comments = $commentModel->findAllBy(['status' => 'APPROVED', 'post_id'=>$postId]);
        $user= new User();
        foreach ($comments as $comment){
            $comment->created_at = $comment->getFrDate($comment->created_at);
            $comment->user_id= $user->findById(intval($comment->user_id));
        }
        return $comments;
    }
}