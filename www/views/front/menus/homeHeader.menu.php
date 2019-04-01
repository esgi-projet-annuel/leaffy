<header id="header-home" class="header-front-page">
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-8">
                    <a href="<?php echo Routing::getSlug("Static","showHomePage");?>">
                        <img class="header-logo-img" src="../../../public/img/logo_full.png" width="100">
                    </a>
                </div>
                <div class="col-sm-8 col-4">
                    <nav class="header-navigation">
                        <ul id="menu-main" class="clearfix"><li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-16"><a href="<?php echo Routing::getSlug("Static","showHomePage");?>">Accueil</a></li>
                            <li id="menu-item-17" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-17"><a href="<?php echo Routing::getSlug("Static","showAboutPage");?>">À Propos</a></li>
                            <li id="menu-item-18" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-18"><a href="">Mon Approche</a></li>
                            <li id="menu-item-19" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-19"><a href="">Mes Prestations</a></li>
                            <li id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-20"><a href="<?php echo Routing::getSlug("Static","showBlogPage");?>">Blog</a></li>
                            <li id="menu-item-22" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-22"><a href="<?php echo Routing::getSlug("Static","showContactPage");?>">Contact</a></li>
                            <?php if (isset($_SESSION)):
                                $user= new User();
                                $user->findOneBy(['email'=>$_SESSION['email']], true); ?>
                                <li id="menu-item-23" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-23"><a href="<?php echo Routing::getSlug("Authentication","userLogout");?>"><?php echo $user->firstname;?></a></li>
                            <?php else:?>
                            <li id="menu-item-23" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-23"><a href="<?php echo Routing::getSlug("Authentication","viewUserLoginForm");?>"><img src="../../../public/img/user.png" width="25"></a></li>
                            <?php endif;?>
                        </ul>
                    </nav>
                    <nav class="menu-responsive">
                      <div class="burger-img">
                        <img class="burger" src="../../../public/img/burger-light.png" width="40">
                      </div>
                    </nav>
                </div>
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
