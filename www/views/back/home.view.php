<?php
use LeaffyMvc\Models\Testimonial ;


$testimonial = new Testimonial();
$testimonialsApproved = $testimonial->findAllBy(['status'=>'APPROVED']);
$testimonialsPending = $testimonial->findAllBy(['status'=>'PENDING']);
$testimonialsRejected = $testimonial->findAllBy(['status'=>'REJECTED']);
// echo '<pre>';
// var_dump($testimonialsApproved);
// var_dump($testimonialsPending);
// echo '</pre>';
$testimonialCountApproved = count($testimonialsApproved);
$testimonialCountPending = count($testimonialsPending);
$testimonialCountRejected = count($testimonialsRejected);


foreach ($testimonialsApproved as $testimonialApproved) {
  $dateTestimonialApproved = $testimonialApproved->created_at;
  $dateTestimonialApproved = date("d/m/Y", strtotime($dateTestimonialApproved));
}
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
              <h3>Nombre d'utilisateurs</h3>
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
              <a href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Article","showOne");?>">- Ecrire un article</a>
              <a href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Page","showOne");?>">- Ajouter une page</a>
              <a href="#">- Gérer les utilisateurs</a>
              <a href="#">- Aller sur le site</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var datatime = <?php echo json_encode($dateTestimonialApproved); ?>;
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

  var ctx = document.getElementById("myChart2").getContext('2d');
  var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
      labels: date,
      datasets: [{
          label: 'Nombre d\'inscriptions',
          data: [2, 4, 12, 6, 7, 5],
          backgroundColor: [
           'rgba(54, 162, 235, 0.5)',
          ],
          borderColor: [
              'rgba(54, 162, 235, 1)',

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
