<?php $this->addHeader("header", "front");
global $user;
$user = new \LeaffyMvc\Models\User();
$user->findOneObjectBy(['email'=>$_GET['email']]);
if(!empty($user)) {
    // Récupération de la clé
    $token =$user->token;
}
    if($_GET['token'] == $token) {
        $this->addModal("formResetPassword", $formResetPassword);
    }else {
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
