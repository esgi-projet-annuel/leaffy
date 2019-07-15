<?php
use LeaffyMvc\Models\User;
$user = new User();
$user->findOneObjectBy(['profile'=>'ADMIN']);

?>
<header id="header-home" class="header-front-page">
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-8">
                    <a href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Page","showFrontPage")."?page=1";?> ">
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
                            <?php if($user->firstname && $user->lastname): ?>
                            <h1><?php echo $user->firstname .' '. $user->lastname ?></h1>
                            <?php else: ?>
                            <h1>Bienvenue sur mon site !</h1>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                          <?php if($user->firstname && $user->lastname): ?>
                            <h2>Bienvenue sur mon site</h2>
                          <?php endif; ?>
                        </div>
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="section-description section-description--header"></div>
                            <a href="#discover-anchor"  class="button--one button">Découvrir</a>
                        </div>
                    </div>
                </div>
            </div>
</header>
