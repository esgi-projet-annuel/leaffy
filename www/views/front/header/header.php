<header id="header" class="header-front-page">
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-8">
                    <a href="<?php echo Routing::getSlug("Static","showFrontPage")."?page=1";?>">
                        <img class="header-logo-img" src="../../public/img/logo_full.png" width="100">
                    </a>
                </div>
                <?php $this->addMenu("menu", "front")?>
            </div>
        </div>
    </div>
</header>
