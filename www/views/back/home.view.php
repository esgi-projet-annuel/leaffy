<div class="container-back">

    <?php $this->addMenu("back", "back");?><!--    include menu-->

  <div id="content-back" class="">
    <div class="titre">
      <h2>Tableau de bord</h2>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-12">
          <div class="bloc-tab chart">
            <div class="title">
              <h3>Nombre de visites</h3>
            </div>
            <canvas id="myChart" width="400" height="300"></canvas>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="bloc-tab chart">
            <div class="title">
              <h3>Durée des visites</h3>
            </div>
            <canvas id="myChart2" width="400" height="300"></canvas>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="bloc-tab chart">
            <div class="title">
              <h3>Acquisition / fidélité</h3>
            </div>
            <canvas id="myChart3" width="400" height="300"></canvas>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="acces-rapide bloc-tab">
            <div class="title">
              <h3>Accès Rapide</h3>
            </div>
            <div class="acces-rapide">
              <a href="#">- Ecrire un article</a>
              <a href="#">- Ajouter une page</a>
              <a href="#">- Gérer les utilisateurs</a>
              <a href="#">- Aller sur le site</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
