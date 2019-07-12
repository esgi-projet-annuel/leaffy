<?php $this->addHeader("header", "front")?>
<main>
  <div class="container">
    <div class="card card-login card card-login mx-auto mt-5">
      <div class="card-header">Connexion</div>
      <div class="card-body">
        <?php $this->addModal("form", $form);?>

        <div class="text-center">
          <a class="small" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("User","showRegisterForm");?>">Créer un compte</a>
          <a class="small" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("User","showForgottenPasswordForm");?>">Mot de passe oublié ?</a>
        </div>
      </div>
    </div>
  </div>
</main>
