<?php $this->addHeader("header", "front")?>
<main>
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Créer un compte</div>
        <div class="card-body">

        <?php $this->addModal("form", $form);?>

        <div class="text-center">
          <a class="d-block small mt-3" href="">Page de connexion</a>
          <a class="d-block small" href="">Mot de passe oublié ?</a>
        </div>
      </div>
    </div>
  </div>
</main>
