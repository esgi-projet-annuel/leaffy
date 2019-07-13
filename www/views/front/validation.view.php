<?php $this->addHeader("header", "front")?>
<?php // Récupération de la clé correspondant au $login dans la base de données
$user = new \LeaffyMvc\Models\User();
$user->findOneObjectBy(['email'=>$_GET['email']]);

if(!empty($user)) {
    // Récupération de la clé
    $token =$user->token;
    // $actif contiendra alors 0 ou 1
    $active=$user->active;
} ?>

<main>
  <div class="validation-page">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <?php
          // On teste la valeur de la variable $actif récupéré dans la BDD
          if($active == '0'){ // Si le compte est déjà actif on prévient
              if($_GET['token'] == $token) // On compare nos deux clés
              {
                  // Si elles correspondent on active le compte !
                  echo "<p class='validation'>Votre compte a bien été activé !</p>";
                  $user->setActive(1);
                  $user->save();
              }
              else // Si les deux clés sont différentes on provoque une erreur...
              {
                  echo "<p class='validation'>Erreur ! Votre compte ne peut être activé...</p>";
              }

          } else if($active == '1'){ // Si ce n'est pas le cas on passe aux comparaisons

              echo "<p class='validation'>Votre compte est déjà actif !</p>";
          }else{
              echo "<p class='validation'>Erreur 404</p>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</main>
