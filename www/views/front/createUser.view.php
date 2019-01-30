<div class="container">
  <div class="card card-register mx-auto mt-5">
    <div class="card-header">Créer un compte</div>
      <div class="card-body">
        <form action="" method="post">
            <div class="form-login">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-label-login">
                    <label for="firstName">Prénom</label>
                    <input type="text" id="firstName" class="form-control-login" placeholder="First name" required="required" autofocus="autofocus" name="firstName" value="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-login">
                    <label for="lastName">Nom</label>
                    <input type="text" id="lastName" class="form-control-login" placeholder="Last name" required="required" name="lastName" value="">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-login">
              <div class="form-label-login">
                <label for="inputEmail">Email</label>
                <input type="email" id="inputEmail" class="form-control-login" placeholder="Email address" required="required" name="inputEmail" value="">
              </div>
            </div>
            <div class="form-login">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-label-login">
                    <label for="inputPassword">Mot de passe</label>
                    <input type="password" id="inputPassword" class="form-control-login" placeholder="Password" required="required" name="inputPassword">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-login">
                    <label for="confirmPassword">Confirmer le mot de passe</label>
                    <input type="password" id="confirmPassword" class="form-control-login" placeholder="Confirm password" required="required" name="confirmPassword">
                  </div>
                </div>
              </div>
            </div>
            <center>
              <input class="form-control submit-button" type="submit" name="" value="S'enregistrer">
            </center>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="<?php echo Routing::getSlug("User","authenticateUser");?>">Page de connexion</a>
            <a class="d-block small" href="">Mot de passe oublié ?</a>
          </div>
        </div>
      </div>
    </div>
