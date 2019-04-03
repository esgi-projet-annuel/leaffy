<header id="header-home" class="header-front-page">
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-8">
                    <a href="<?php echo Routing::getSlug("Static","showHomePage");?>">
                        <img class="header-logo-img" src="../../../public/img/logo_full.png" width="100">
                    </a>
                </div>
                <?php $this->addMenu("menu", "front")?>
            </div>
        </div>
    </div>
            <div class="bottom-header front-page">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1>Lorem ipsum dolor sit amet</h1>
                        </div>
                        <div class="col-12">
                            <h2>Lorem ipsum dolor</h2>
                        </div>
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="section-description section-description--header">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum odio eget nisi hendrerit, nec imperdiet mi consectetur. Curabitur in sem ut !</div>
                            <a href="#"  class="button--one button">Découvrir</a>
                            <a href="#" class="button--two button">Rendez-vous</a>
                        </div>
                    </div>
                </div>
            </div>
</header>
