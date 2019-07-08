<?php
use LeaffyMvc\Core\Routing;
$this->addHeader("header", "front")
?>
<!--TODO FABIEN Mettre en forme l'affichage des articles -->
<div class="col-12">
    <h1 class="h3">Blog</h1>
</div>
<div class="container">
  <div class="main-blog">


      <?php
          $str='';
          foreach ($posts as $post){
              $str.= '<div class="row">';
              $str.= '<div class="col-12">';
              $str.= '<div class="post-blog">';
              $str.= '<h2 class="blog-title">'.$post->title.'</h2>';
              $str.= '<span class="blog-date">Publié le : '.$post->getFrDate($post->created_at).'</span>';
              $str.= '<p class="blog-description">'.$post->description.'</p>';
              $str.= '<a class="more post-button" href="'. Routing::getSlug("Post", "showOnePost").'?id='.$post->id.'"><i class="fa fa-chevron-circle-right"></i> Lire l\'article</a>';
              $str.= '</div>';
              $str.= '</div>';
              $str.= '</div>';
          }
          print $str;
      ?>
  </div>
</div>
