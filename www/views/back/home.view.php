<!-- <a href="<?php // echo Routing::getSlug("Authentication","viewAdminLoginForm");?>">Login Admin</a>
<a href="<?php // echo Routing::getSlug("Settings","default");?>">Settings</a>
<a href="<?php// echo Routing::getSlug("Menu","default");?>">Menu</a>
<a href="<?php// echo Routing::getSlug("Article","showAll");?>">Articles</a>
<a href="<?php// echo Routing::getSlug("Page","showAll");?>">Pages</a> -->


<div id="header-back" class="header-back-page">
  <div class="part-1-header-back">
    <div class="logo-back">
      <a href="#">
          <img class="back-header-logo-img" src="../../public/img/logo_full.png" width="70">
      </a>
    </div>
    <a href="#">
      <div class="button button--three">
        Aller sur le site
      </div>
    </a>
  </div>
  <div class="part-2-header-back">
    <h1>Bienvenue dans l'administration de votre site</h1>
  </div>
  <div class="part-3-header-back">
    <span class="admin-name">
      Bonjour, Admin Name
    </span>
    <div class="button connexion-button">
      Déconnexion
    </div>
  </div>

</div>
<div class="container-back">
  <div id="adminbar" class="">
    <ul class="list-admin-bar">
      <li class="list-item">
        <img src="../../public/img/home.png" width="40">
        <div>Tableau de bord</div>
      </li>
      <li class="list-item active">
        <img src="../../public/img/id-card-darken.png" width="40">
        <div>Informations personnelles</div>
      </li>
      <li class="list-item">
        <img src="../../public/img/newspaper.png" width="40">
        <div>Blog</div>
      </li>
      <li class="list-item">
        <img src="../../public/img/browser.png" width="40">
        <div>Pages</div>
      </li>
      <li class="list-item">
        <img src="../../public/img/menu-options.png" width="40">
        <div>Menu</div>
      </li>
      <li class="list-item">
        <img src="../../public/img/blogging.png" width="40">
        <div>Commentaires</div>
      </li>
      <li class="list-item">
        <img src="../../public/img/contact-darken.png" width="40">
        <div>Utilisateurs</div>

      </li>
      <li class="list-item">
        <img src="../../public/img/image-darken.png" width="40">
        <div>Médias</div>

      </li>
      <li class="list-item">
        <img src="../../public/img/line-chart.png" width="40">
        <div>Statistiques</div>
      </li>
      <li class="list-item">
        <img src="../../public/img/settings-darken.png" width="40">
        <div>Réglages</div>
      </li>
    </ul>
  </div>
  <div id="content-back" class="">
    <div class="">
      <div class="titre">
        <h2>Informations personnelles</h2>
      </div>
    </div>
    <form class="" action="index.html" method="post">
      <div class="section">
          <div class="container">
              <div class="row">
                <div class="col-6 fields-input-back">
                  <label> Votre Nom<br />
                      <span class="form-control your-subject">
                        <input type="text" name="your-subject" value="" size="40" class="form-control form-text" aria-invalid="false" />
                      </span>
                  </label>
                  <label> Votre Prénom<br />
                      <span class="form-control your-subject">
                        <input type="text" name="your-subject" value="" size="40" class="form-control form-text" aria-invalid="false" />
                      </span>
                  </label>
                  <label> Votre Numéro<br />
                      <span class="form-control your-subject">
                        <input type="text" name="your-subject" value="" size="40" class="form-control form-text" aria-invalid="false" />
                      </span>
                  </label>
                  <label> Votre Email<br />
                      <span class="form-control your-subject">
                        <input type="text" name="your-subject" value="" size="40" class="form-control form-text" aria-invalid="false" />
                      </span>
                  </label>
                  <label> Votre Adresse<br />
                      <span class="form-control your-subject">
                        <input type="text" name="your-subject" value="" size="40" class="form-control form-text" aria-invalid="false" />
                      </span>
                  </label>
                  <label> Votre Profession<br />
                      <span class="form-control your-subject">
                        <input type="text" name="your-subject" value="" size="40" class="form-control form-text" aria-invalid="false" />
                      </span>
                  </label>
                </div>
                <div class="col-sm-4 col-12 d-flex">
                  <div id="avatar-back" class="margin-auto d-flex">
                      <img class="margin-auto" src="../../public/img/avatar.jpg" alt="">
                      <div class="form-control your-name">
                        <input type="file" name="your-file" value="" size="40" class="form-control form-file" aria-required="true" aria-invalid="false" />
                      </div>
                  </div>
                </div>
                <div class="col-sm-8 col-12">
                  <div>À propos de vous</div>
                  <div class="section-description section-description--about">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum odio eget nisi hendrerit, nec imperdiet mi consectetur. Curabitur in sem ut ex pulvinar laoreet. Phasellus ac luctus nisl. In id velit sit amet enim hendrerit luctus ut eget mi. Phasellus eget ullamcorper sapien. Nullam mi diam, aliquam et quam dignissim, congue sollicitudin ex. Fusce iaculis</p>
                      </br>
                  </div>
                </div>
              </div>
              <div>
                  <input type="submit" value="Enregistrer" class="form-control submit-button" />
              </div>
          </div>
      </div>
    </form>
  </div>
</div>
