<?php $this->addHeader("header", "front")?>


<h2>Mot de passe oublié?</h2>
<p>Vous pouvez le réinitialiser ici!</p>

<?php
    if(isset($message) && !empty($message)){
    echo "<p>".$message. "</p>";
}
?>
<div>
    <form method="POST" action="<?php echo \LeaffyMvc\Core\Routing::getSlug('User','sendMailToResetPassword')?>">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <input type="submit" value="Envoyer">
    </form>

</div>