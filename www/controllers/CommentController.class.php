<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Comment;
use LeaffyMvc\Core\Validator;

class CommentController extends AbstractController
{
    public function getCommentForm(): array{
        $comment = new Comment();
        $form = $comment->getCommentForm();
        return $form;
    }

    public function saveComment(): void {
        $comment = new Comment();
        $form = $comment->getCommentForm();

        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {
            $validator = new Validator($form, $data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){
                $comment->setContent($data['content']);
                $comment->setUserId($_SESSION['userId']);
                $comment->setPostId(intval($_POST['postId']));
                $comment->setStatus('PENDING');
                $comment->save();
            }
        }
    }

    public function approveComment(): void
    {
        var_dump($_POST);
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
        var_dump($_POST);
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
        $view = new View("comments", "back");
        $view->assign("comments", $comments);
    }
}