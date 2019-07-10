<?php $this->addHeader("header", "front")?>

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
          <!-- TODO ALix faire la boucle pour reccuperer les commentaires -->
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
                              <p>Name Author</p>
                            </div>
                            <div class="date-comment">
                              <p>Publié le ...</p>
                            </div>
                            <div class="comment">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
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
          <!-- END -->
          <h3 class="h2">
            Rédiger un commentaire sur l'article !
          </h4>
          <div class="comment-form-part">
            <div class="comment-form">
              <?php $commentController = new \LeaffyMvc\Controllers\CommentController();
              $this->addModal("formComment", $commentController->getCommentForm());?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
