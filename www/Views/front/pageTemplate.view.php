<?php $this->addHeader("header", "front");
?>

<div class="container">
  <div class="main-page">
    <h1 class="h3"><?= $page->title ?></h1>
    <div class="row">
      <div class="col-12">
        <div  class="content-page">
          <?= $page->content?>
        </div>
      </div>
    </div>
    <div class='align-center mt-20'><a href='<?php echo \LeaffyMvc\Core\Routing::getSlug("Page","showFrontPage")."?page=1";?> ' title='Retour' class=' button button--three'><i class='fa fa-chevron-circle-right'></i> Retour</a></div>
  </div>
</div>
