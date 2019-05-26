<div id="adminbar" class="">
    <ul class="list-admin-bar">
      <a class="link" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Static","showBackPage");?>">
        <li class="list-item">
            <img src="../../../public/img/home.png" width="40">
            <div>Tableau de bord</div>
        </li>
      </a>
      <a class="link" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("User","showUpdateForm");?>">
        <li class="list-item">
            <img src="../../../public/img/id-card-darken.png" width="40">
            <div>Informations personnelles</div>
        </li>
      </a>
      <a class="link" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Post", "getAllPostsByStatus");?>">
        <li class="list-item">
            <img src="../../../public/img/newspaper.png" width="40">
            <div>Article</div>
        </li>
      </a>
      <a class="link" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Page", "getAllPagesByStatus");?>">
        <li class="list-item">
            <img src="../../../public/img/browser.png" width="40">
            <div>Pages</div>
        </li>
      </a>
      <a class="link" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Comment", "listPendings");?>">
        <li class="list-item">
            <img src="../../../public/img/blogging.png" width="40">
            <div>Commentaires</div>
        </li>
      </a>
        <a class="link" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("User", "");?>">
        <li class="list-item">
            <img src="../../../public/img/contact-darken.png" width="40">
            <div>Utilisateurs</div>

        </li>
        </a>
        <a class="link" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Testimonial", "listTestimonialsByStatus");?>">
        <li class="list-item">
            <img src="../../../public/img/rating.png" width="40">
            <div>Témoignages</div>
        </li>
        </a>
        <a class="link" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Media", "");?>">
        <li class="list-item">
            <img src="../../../public/img/image-darken.png" width="40">
            <div>Médias</div>
        </li>
        </a>
    </ul>
</div>
