<?php $this->addHeader("header", "front")?>
<?php $postModel= new \LeaffyMvc\Models\Post();

    $post = $postModel->findById('1010');
//    $commentController = new \LeaffyMvc\Controllers\CommentController();
    $str='';

        $str.= '<div class="container">';
        $str.= '<div class="main-article">';
        $str.= '<h1 class="h3">'.$post->title.'</h1>';
        $str.= '<div class="row">';
        $str.= '<div class="col-12">';
        $str.= '<div  class="content-post">';
        $str.= '<span class="blog-date">Publié le : '.date("d/m/Y", strtotime($post->created_at)).'</span>';
        $str.= '<div">'.$post->content.'</div>';
        $str.= '<div  class="comment-post">';
//        $str.= '<div>'.$this->addModal("formComment", $commentController->getCommentForm()).'</div>';
        $str.= '</div>';
        $str.= '</div>';
        $str.= '</div>';
        $str.= '</div>';
        $str.= '</div>';
        $str.= '</div>';

    print $str;
?>
