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
  </div>
</div>
