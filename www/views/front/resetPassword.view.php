<?php $this->addHeader("header", "front");
$user = new \LeaffyMvc\Models\User();
$user->findOneObjectBy(['email'=>$_GET['email']]);

$resetForm =<<<EOF
  <p>Veuillez saisir votre nouveau mot de passe</p>
  <form method="post" action="">
    <div>
        <label for="pass">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div>
        <label for="pass">Confirmation:</label>
        <input type="password" id="confirmation" name="confirmation" required>
    </div>
    <input type="hidden" value="$user->id">

    <input type="submit" id="userId" name="userId" value="Valider">
  </form>
EOF;

if(!empty($user)) {
    // Récupération de la clé
    $token =$user->token;
}
    if($_GET['token'] == $token) {
        echo $resetForm;
    }
    else {
        echo "Erreur ! Le mot de passe ne peut etre changé...";
    }

?>

