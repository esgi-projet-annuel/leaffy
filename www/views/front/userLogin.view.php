<?php $this->addMenu("front", "front")?>

<div class="container">
  <div class="card card-login card card-login mx-auto mt-5">
    <div class="card-header">Connexion</div>
    <div class="card-body">

      <?php $this->addModal("form", $form);?>
        
      <div class="text-center">
        <a class="small" href="<?php echo Routing::getSlug("User","createUser");?>">Créer un compte</a>
        <a class="small" href="">Mot de passe oublié ?</a>
      </div>
    </div>
  </div>
</div>
