<div class="col-sm-8 col-4">
  <div class="nav-wrapper">
    <input class="hidden-front" type="checkbox" id="menuToggle-front">
    <label class="menu-btn-front" for="menuToggle-front">
      <span class="menu-front"></span>
      <span class="menu-front"></span>
      <span class="menu-front"></span>
    </label>
    <nav class="nav-container">
      <ul id="menu-main" class="nav-tabs">
        <?php $menu= new \LeaffyMvc\Controllers\MenuController();
        echo $menu->generateMenu()?>
        <li id="menu-sup" class="menu-item menu-item-home has-submenu"><img src="../../../public/img/user.png" width="25" alt="user-logo"></a>
          <ul class="submenu">
            <?php if (isset($_SESSION['token'])):
                $user= new \LeaffyMvc\Models\User();
                $user->findOneObjectBy(['email'=>$_SESSION['email']]); ?>
                <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home submenu-item"><?php echo $user->firstname;?></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home submenu-item"><a href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Authentication","userLogout");?>">Se déconnecter</a></li>
            <?php else:?>
                <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home submenu-item"><a href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Authentication","viewUserLoginForm");?>">Se connecter</a></li>
            <?php endif;?>
		      </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
