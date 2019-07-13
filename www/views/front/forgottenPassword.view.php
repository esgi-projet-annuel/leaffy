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
        <div>
            <form method="POST" action="<?php echo \LeaffyMvc\Core\Routing::getSlug('User','sendMailToResetPassword')?>">
              <div class="form-login">
                <label for="email">Email:</label>
                <input class="form-control-login" type="text" id="email" name="email">
              </div>
              <div class="d-flex justify-content-around">
                <input class="form-control button-back button-back--add" type="submit" value="Envoyer">
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</main>
