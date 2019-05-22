<div id="content-back" class="">
  <div class="">
    <div class="titre">
      <h2>Gestion des témoignages</h2>
    </div>
  </div>
  <div class="section-table">
    <table class="table" width="100%">
        <tr class="table-head">
          <th align="left">Nom</th>
          <th align="left">Prénom</th>
          <th align="left">Témoignages</th>
          <th width="25%"></th>
        </tr>
        <?php
        $controller = new \LeaffyMvc\Controllers\TestimonialController();
        $testimonials = $controller->listPendings();

        foreach ($testimonials as $testimonial) {
            echo '<tr>'
                .'<td>' . $testimonial->userName . '</td>'
                . '<td>' . $testimonial->content . '</td>'
                . '<td>Publié le ' . $testimonial->created_at . '</td>'
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
            url : '/admin/deletePage',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + testimonialId,
        });
    }

    function rejecte(pageId) {
        $.ajax({
            url : '/admin/deletePage',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + pageId,
        });
    }
</script>
