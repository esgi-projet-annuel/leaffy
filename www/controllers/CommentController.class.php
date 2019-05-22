<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Comment;

class CommentController extends AbstractController
{

    public function saveComment(): void
    {
        $comment = new Comment();
        $data = $_POST; //TODO a supprimer et décommenter ligne de dessus
        if (!empty($data)) {
            $comment->setContent($data['content']);
            $comment->setUserId($_SESSION['userId']);
            $comment->setPostId(intval($_POST['postId']));
            $comment->setStatus('PENDING');
            $comment->save();
        }
    }

    public function approveComment(): void
    {
        $this->checkAdmin();
        $commentId = intval($_POST['commentId']);
        $comment = new Comment();
        $comment->findById($commentId);
        $data = $_POST;
        if(!empty($data) ){
            $comment->setStatus('APPROVED');
            $comment->save();
        }
    }

    public function rejectComment(): void
    {
        $this->checkAdmin();
        $commentId = intval($_POST['commentId']);
        $comment = new Comment();
        $comment->findById($commentId);
        $data = $_POST;
        if(!empty($data) ){
            $comment->setStatus('REJECTED');
            $comment->save();
        }
    }

    public function listPendings(): array {
        //$this->checkAdmin();
//        $postId = intval($_POST['postId']);
        $comment = new Comment();
        $pendingComments = $comment->findAllBy(['status' =>  'PENDING']); //, 'post_id' => $postId

        var_dump($pendingComments);
        return $pendingComments;
    }
}