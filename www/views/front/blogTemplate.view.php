<?php $this->addHeader("header", "front")?>
<!--TODO FABIEN Mettre en forme l'affichage des articles -->

<div> <?php echo $page->content?></div>

<?php $postModel= new \LeaffyMvc\Models\Post();
    $posts = $postModel->findAllBy(['status'=>'PUBLISHED']);
//    $commentController = new \LeaffyMvc\Controllers\CommentController();
    $str='';
    foreach ($posts as $post){
        $str.= '<div>';
        $str.= '<h2>'.$post->title.'</h2>';
        $str.= '<div>'.$post->content.'</div>';
//        $str.= '<div>'.$this->addModal("formComment", $commentController->getCommentForm()).'</div>';
        $str.= '</div>';

    }
    print $str;
?>