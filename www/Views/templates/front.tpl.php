<!DOCTYPE html>

<html lang="fr">
<?php
use LeaffyMvc\Models\User;
$user = new User();
$user->findOneObjectBy(['profile'=>'ADMIN']);

?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../../public/css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <script src="../../public/js/jquery-3.3.1.min.js"></script>
        <script src="../../public/js/script.js"></script>
        <script src="../../public/js/scrollEvent.js"></script>
<!--        TODO importer description du professionnel-->
        <meta name="description" content="">
        <meta name="author" content="<?php echo $user->firstname .' '. $user->lastname ?>">
        <title><?php echo $user->firstname .' '. $user->lastname ?> - Leaffy</title>
    </head>
    <body>

      <?php include $this->view;?>

      <footer id="footer">
          <div class="container">
              <div class="row">
                  <div class="col-md-3 col-sm-6 col-12">
                      <a class="footer-link" href=""><p>Prendre Rendez-vous</p></a>
                  </div>
                  <div class="col-md-3 col-sm-6 col-12">
                      <a class="footer-link" href=""><p>Mon Compte</p></a>
                  </div>
                  <div class="col-md-3 col-sm-6 col-12">
                      <a class="footer-link" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Static","showCGUView");?>"><p>CGU</p></a>
                  </div>
                  <div class="col-md-3 col-sm-6 col-12">
                      <a class="footer-link" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Static","showMentionView");?>"><p>Mentions Légales</p></a>
                  </div>
              </div>
          </div>
          <div class="bottom-footer">
              <div class="copyright d-flex">
                  <span>Propulsé par Leaffy</span>
                  <span class="bottom-copyright" data-customizer="copyright-credit">© Copyright 2019. Tous droits réservés.</span>
              </div>
          </div>
          <script src="../../public/js/scriptTestiSlider.js"></script>
      </footer>
    </body>
</html>
