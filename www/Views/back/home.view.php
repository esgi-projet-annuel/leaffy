<?php
use LeaffyMvc\Models\Testimonial ;
use LeaffyMvc\Models\User ;

$testimonial = new Testimonial();
$testimonialsApproved = $testimonial->findAllBy(['status'=>'APPROVED']);
$testimonialsPending = $testimonial->findAllBy(['status'=>'PENDING']);
$testimonialsRejected = $testimonial->findAllBy(['status'=>'REJECTED']);
$testimonialCountApproved = count($testimonialsApproved);
$testimonialCountPending = count($testimonialsPending);
$testimonialCountRejected = count($testimonialsRejected);

$users = new User();
$UsersActive = $users->findAllBy(['profile'=>'CLIENT','active'=>'1']);
$userTable = [];
$userCount = [];
foreach ($UsersActive as $UserActive) {
  $UserDate = $UserActive->created_at;
  $UserDate = date("d/m/Y", strtotime($UserDate));
  if(!in_array($UserDate, $userTable, true)){
       array_push($userTable, $UserDate);
   }
   array_push($userCount, $UserDate);
}
$userCountValue = array_values(array_count_values($userCount));

 ?>

  <div id="content-back" class="">
    <div class="titre">
      <h2>Tableau de bord</h2>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-12">
          <div class="bloc-tab chart">
            <div class="title">
              <h3>Nombre de témoignages</h3>
            </div>
            <canvas id="myChart" width="400" height="300"></canvas>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="bloc-tab chart">
            <div class="title">
              <h3>Nombre d'inscriptions validés</h3>
            </div>
            <canvas id="myChart2" width="400" height="300"></canvas>
          </div>
        </div>
        <div class="col-md-offset-3 col-md-6 col-12">
          <div class="acces-rapide bloc-tab">
            <div class="title">
              <h3>Accès Rapide</h3>
            </div>
            <div class="acces-rapide">
              <a href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Post","createPost");?>">- Ecrire un article</a>
              <a href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Page","createPage");?>">- Ajouter une page</a>
              <a href="<?php  echo \LeaffyMvc\Core\Routing::getSlug("User", "getAllUsersByProfile");?>">- Gérer les utilisateurs</a>
              <a href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Page","showFrontPage")."?page=1";?>">- Aller sur le site</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var dataCountApproved = <?php echo json_encode($testimonialCountApproved); ?>;
  var dataCountPending = <?php echo json_encode($testimonialCountPending); ?>;
  var dataCountRejected = <?php echo json_encode($testimonialCountRejected); ?>;
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
      labels: ['Approuvé', 'En attente', 'Rejeté'],
      datasets: [{
          label: 'Nombre de visites',
          data: [dataCountApproved, dataCountPending,dataCountRejected],
          backgroundColor: [
           'rgba(116, 180, 155, 0.8)',
           'rgba(116, 134, 180, 0.8)',
           'rgba(180, 116, 116, 0.8)'
          ],
          borderColor: [
            'rgba(116, 180, 155, 0.8)',
            'rgba(116, 134, 180, 0.8)',
            'rgba(180, 116, 116, 0.8)'
          ],
          borderWidth: 1
      }]
  },
  options: {
      scales: {
        yAxes: [{
          ticks: {
              beginAtZero:true
          }
        }],
      },
      legend: {
          labels: {
              fontColor: "black",
              fontSize: 18
          }
      },
      responsive: true
  }
  });
  var userDate = <?php echo json_encode($userTable); ?>;
  var userCount = <?php echo json_encode($userCountValue); ?>;
  var ctx = document.getElementById("myChart2").getContext('2d');
  var myChart = new Chart(ctx, {
  type: 'line',
  data: {
      labels: userDate,
      datasets: [{
          label: 'Nombre d\'inscriptions',
          backgroundColor : 'rgba(116, 134, 180, 0.8)',
          borderColor : "black",
          borderWidth: 1,
          data: userCount
      }]
  },
  options: {
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero:true
              }
          }]
      },
      legend: {
          labels: {
              fontColor: "black",
              fontSize: 18
          }
      },
      responsive: true
  }
  });
</script>
