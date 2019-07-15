<?php
use LeaffyMvc\Controllers\CommentController;
$this->addHeader("header", "front")?>

<div class="container">
  <div class="main-article">
    <h1 class="h3"><?= $post->title ?></h1>
    <div class="row">
      <div class="col-12">
        <div  class="content-post">
          <span class="blog-date">Publié le : <?= date("d-m-Y", strtotime($post->created_at)); ?></span>
          <div> <?= $post->content ?></div>
        </div>
        <div class="comment-part">
            <?php
            $commentController= new CommentController();
            $comments= $commentController->listApprovedCommentsByPost($post->id);
            $str='';
            foreach ($comments as $comment){
                $commentUser =$comment->user_id;
                $str .=<<<EOF
                <div  class="comment-post">
                            <div class="container">
                              <div class="row">
                                <div class="col-12">
                                  <div class="comment-block">
                                    <div class="container">
                                      <div class="row">
                                        <div class="col-md-2 col-sm-6 col-12">
                                          <div class="comment-part-1">
                                            <div class="avatar-comment">
                                              <img src="../../public/img/avatar_testi.png" width="100">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-10 col-sm-6 col-12">
                                          <div class="comment-part-2">
                                            <div class="author-comment">
                                              <p>$commentUser->firstname</p>
                                            </div>
                                            <div class="date-comment">
                                              <p>Publié le $comment->created_at</p>
                                            </div>
                                            <div class="comment">
                                              <p>$comment->content</p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
EOF;
            }
            print $str;
            ?>
          <div class='align-center mt-20'><a href='\?page=3' title='Retour' class=' button button--three'><i class='fa fa-chevron-circle-right'></i> Retour</a></div>

          <?php if (isset($_SESSION)&& isset($_SESSION['userId'])):?>
            <h3 class="h2">
            Rédiger un commentaire sur l'article !
          </h3>
          <div class="comment-form-part">
            <div class="comment-form">
                <?php if( !empty($errors)):?>
                    <div class="">
                        <ul>
                            <?php foreach ($errors as $error):?>
                            <li><?php echo $error;?>
                                <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
              <?php
                  $commentController = new \LeaffyMvc\Controllers\CommentController();
                  $this->addModal("formComment", $commentController->getCommentForm($post->id));
              ?>
                <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
