<?php $this->addHeader("header", "front")?>
<main>
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Créer un compte</div>
        <div class="card-body">

        <?php $this->addModal("form", $form);?>

        <div class="text-center">
          <a class="d-block small mt-3" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Authentication","viewUserLoginForm");?>">Page de connexion</a>
        </div>
      </div>
    </div>
  </div>
</main>
