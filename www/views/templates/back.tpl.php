<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--        TODO importer description du professionnel-->
    <meta name="description" content="">
    <!--        TODO importer nom du pro-->
    <meta name="author" content="">
    <!--        TODO importer nom du pro + profession-->
    <title>Leaffy Back Office </title>
</head>
    <body>
        <div id="header-back" class="header-back-page">
            <div class="part-1-header-back">
                <div class="logo-back">
                    <a href="<?php echo Routing::getSlug("Admin","showHomeAdmin");?>">
                        <img class="back-header-logo-img" src="../../public/img/logo_full.png" width="70">
                    </a>
                </div>
                <a href="<?php echo Routing::getSlug("Static","showHomePage");?>">
                    <div class="button button--three">
                        Aller sur le site
                    </div>
                </a>
            </div>
            <div class="part-2-header-back">
                <h1>Bienvenue dans l'administration de votre site</h1>
            </div>
            <div class="part-3-header-back">
            <span class="admin-name">
              Bonjour, Admin Name
            </span>
                <a href="#">
                    <div class="button connexion-button">
                        Déconnexion
                    </div>
                </a>
            </div>

        </div>
    <?php include $this->view;?>
    </body>
</html>
