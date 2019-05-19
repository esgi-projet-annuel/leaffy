<?php $this->addHeader("header", "front")?>

<?php

// Récupération de la clé correspondant au $login dans la base de données
$user = new User();
$user->findOneObjectBy(['email'=>$_GET['email']]);

if(!empty($user)) {
    // Récupération de la clé
    $token =$user->token;
    // $actif contiendra alors 0 ou 1
    $active=$user->active;
}


// On teste la valeur de la variable $actif récupéré dans la BDD
if($active == '1'){ // Si le compte est déjà actif on prévient

    echo "Votre compte est déjà actif !";
} else { // Si ce n'est pas le cas on passe aux comparaisons

    if($_GET['token'] == $token) // On compare nos deux clés
    {
        // Si elles correspondent on active le compte !
        echo "Votre compte a bien été activé !";
        $user->setActive(1);
        $user->save();
    }
    else // Si les deux clés sont différentes on provoque une erreur...
    {
        echo "Erreur ! Votre compte ne peut être activé...";
    }
}

?>
