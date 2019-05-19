<div class="col-sm-8 col-4">
    <nav class="header-navigation">
        <ul id="menu-main" class="clearfix">

            <?php $test= new \LeaffyMvc\Controllers\MenuController();
            echo $test->generateMenu()?>
            <?php if (isset($_SESSION['token'])):
                $user= new \LeaffyMvc\Models\User();
                $user->findOneObjectBy(['email'=>$_SESSION['email']]); ?>
                <li id="menu-item-23" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-23"><a href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Authentication","userLogout");?>"><?php echo $user->firstname;?></a></li>
            <?php else:?>
                <li id="menu-item-23" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-23"><a href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Authentication","viewUserLoginForm");?>"><img src="../../../public/img/user.png" width="25"></a></li>
            <?php endif;?>

        </ul>
    </nav>
    <nav class="menu-responsive">
        <div class="burger-img">
            <img class="burger" src="../../../public/img/burger-light.png" width="40">
        </div>
    </nav>
</div>