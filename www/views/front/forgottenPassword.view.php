<?php $this->addHeader("header", "front")?>
<main>
  <div class="container">
    <div class="card card-login card card-login mx-auto mt-5">
      <div class="card-header">Mot de passe oublié ?</div>
      <div class="card-body">
          <p>Saisissez votre email ci-dessous. Nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>

        <?php
            if(isset($message) && !empty($message)){
            echo "<p>".$message. "</p>";
        }
        ?>
        <?php $this->addModal("formForgottenPassword", $formForgottenPassword);?>
      </div>
    </div>
  </div>
</main>
