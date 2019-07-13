<?php $this->addHeader("header", "front");
$user = new \LeaffyMvc\Models\User();
$user->findOneObjectBy(['email'=>$_GET['email']]);

$resetForm =<<<EOF
<main>
  <div class="container">
    <div class="card card-login card card-login mx-auto mt-5">
      <div class="card-header">Mot de passe oublié ?</div>
      <div class="card-body">
        <p>Veuillez saisir votre nouveau mot de passe</p>
        <form method="post" action="">
          <div class="form-login">
              <label for="pass">Password:</label>
              <input class="form-control-login" type="password" id="password" name="password" required>
          </div>

          <div class="form-login">
              <label for="pass">Confirmation:</label>
              <input class="form-control-login" type="password" id="confirmation" name="confirmation" required>
          </div>
          <div class="d-flex justify-content-around">
            <input type="hidden" value="$user->id">
            <input class="form-control button-back button-back--add" type="submit" id="userId" name="userId" value="Valider">
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
EOF;

if(!empty($user)) {
    // Récupération de la clé
    $token =$user->token;
}
    if($_GET['token'] == $token) {
        echo $resetForm;
    }
    else {
        echo "
        <main>
          <div class='container'>
            <div class='container'>
              <div class='row'>
                <div class='col-12'>
                  <p class='validation'>Erreur ! Le mot de passe ne peut pas être changé...</p>
                </div>
              </div>
            </div>
          </div>
        </main>
        ";
    }

?>
