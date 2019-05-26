<div class="col-sm-8 col-4">
  <div class="nav-wrapper">
    <input class="hidden-front" type="checkbox" id="menuToggle-front">
    <label class="menu-btn-front" for="menuToggle-front">
      <div class="menu-front"></div>
      <div class="menu-front"></div>
      <div class="menu-front"></div>
    </label>
    <nav class="nav-container">
      <ul id="menu-main" class="nav-tabs">

          <?php $menu= new \LeaffyMvc\Controllers\MenuController();
          echo $menu->generateMenu()?>
          <?php if (isset($_SESSION['token'])):
              $user= new \LeaffyMvc\Models\User();
              $user->findOneObjectBy(['email'=>$_SESSION['email']]); ?>
              <li id="menu-item-23" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-23"><a href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Authentication","userLogout");?>"><?php echo $user->firstname;?></a></li>
          <?php else:?>
              <li id="menu-item-23" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-23"><a href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Authentication","viewUserLoginForm");?>"><img src="../../../public/img/user.png" width="25"></a></li>
          <?php endif;?>

      </ul>
    </nav>
  </div>
</div>
