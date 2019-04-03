<div class="col-sm-8 col-4">
    <nav class="header-navigation">
        <ul id="menu-main" class="clearfix"><li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-16"><a href="<?php echo Routing::getSlug("Static","showHomePage");?>">Accueil</a></li>
            <li id="menu-item-17" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-17"><a href="<?php echo Routing::getSlug("Static","showAboutPage");?>">À Propos</a></li>
            <li id="menu-item-18" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-18"><a href="">Mon Approche</a></li>
            <li id="menu-item-19" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-19"><a href="">Mes Prestations</a></li>
            <li id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-20"><a href="<?php echo Routing::getSlug("Static","showBlogPage");?>">Blog</a></li>
            <li id="menu-item-22" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-22"><a href="<?php echo Routing::getSlug("Static","showContactPage");?>">Contact</a></li>
            <?php if (isset($_SESSION['token'])):
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