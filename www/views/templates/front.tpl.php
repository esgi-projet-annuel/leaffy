<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--        TODO importer description du professionnel-->
        <meta name="description" content="">
<!--        TODO importer nom du pro-->
        <meta name="author" content="">
<!--        TODO importer nom du pro + profession-->
        <title>Leaffy front</title>
    </head>
    <body>
        <div class="container">
            <?php include $this->view;?>
        </div>

        <a href="<?php echo Routing::getSlug("Static","showHomePage");?>">back</a>

    </body>
</html>