<div id="content-back" class="">
  <div class="">
    <div class="titre">
      <h2>Gestion des témoignages</h2>
    </div>

<!--      TODO FABIEN visuel des boutons/liens/ce que tu veux xD-->
      <a href="/admin/listTestimonials?status=PENDING" class="form-control button-back button-back--modify">Témoignages en attente de validation</a>
      <a href="/admin/listTestimonials?status=APPROVED" class="form-control button-back button-back--modify">Témoignages validés</a>
      <a href="/admin/listTestimonials?status=REJECTED" class="form-control button-back button-back--modify">Témoignages rejetés</a>

  </div>
  <div class="section-table">
    <table class="table" width="100%">
        <tr class="table-head">
          <th align="left">Pseudo</th>
          <th align="left">Témoignage</th>
          <th align="left">date de création</th>
          <th align="left">Status</th>
          <th width="25%"></th>
        </tr>
        <?php
//        $controller = new \LeaffyMvc\Controllers\TestimonialController();
//        $testimonials = $controller->listTestimonialsByStatus();
        foreach ($testimonials as $testimonial) {
            echo '<tr>'
                .'<td>' . $testimonial->user_name . '</td>'
                . '<td>' . $testimonial->content . '</td>'
                . '<td>Publié le ' . $testimonial->created_at . '</td>'
                . '<td>' . $testimonial->status . '</td>'
                . '<td>'
                . '<a href="" class="form-control button-back button-back--display" onclick="approve('. $testimonial->id .');">Valider</a>'
                . '<a href="" class="form-control button-back button-back--modify" onclick="rejecte('. $testimonial->id .');">Rejeter</a>'
                . '</td>'
                . '</tr>';
        }
        ?>
    </table>
  </div>
</div>

<script type="text/javascript">
    function approve(testimonialId) {
        $.ajax({
            url : '/admin/approveTestimonial',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + testimonialId,
        });
    }

    function rejecte(pageId) {
        $.ajax({
            url : '/admin/rejectTestimonial',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + pageId,
        });
    }

    function listTestimonialsByStatus(status) {
        $.ajax({
            url : '/admin/listTestimonials?status=' + status,
            type : 'GET' // Le type de la requête HTTP, ici devenu POST
        });
    }
</script>
