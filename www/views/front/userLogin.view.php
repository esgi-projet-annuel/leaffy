<div class="container">
  <div class="card card-login card card-login mx-auto mt-5">
    <div class="card-header">Connexion</div>
    <div class="card-body">
      <form method="post">
        <div class="form-login">
          <div class="form-label-login">
            <label for="inputEmail">Email</label>
            <input type="email" id="inputEmail" class="form-control-login" placeholder="Email address" required="required" autofocus="autofocus" name="inputEmail">
          </div>
        </div>
        <div class="form-login">
          <div class="form-label-login">
            <label for="inputPassword">Mot de passe</label>
            <input type="password" id="inputPassword" class="form-control-login" placeholder="Password" required="required" name="inputPassword">
          </div>
        </div>

        <input type="submit" class="form-control submit-button" value="Connexion">
      </form>
      <div class="text-center">
        <a class="small" href="<?php echo Routing::getSlug("User","createUser");?>">Créer un compte</a>
        <a class="small" href="">Mot de passe oublié ?</a>
      </div>
    </div>
  </div>
</div>
