<div id="content-back" class="">
  <div class="">
    <div class="titre">
      <h2>Gestion des témoignages</h2>
    </div>
      <div class="group-button">
        <a href="/admin/listTestimonials?status=PENDING" class="form-control button-back button-back--status">Témoignages en attente de validation</a>
        <a href="/admin/listTestimonials?status=APPROVED" class="form-control button-back button-back--status">Témoignages validés</a>
        <a href="/admin/listTestimonials?status=REJECTED" class="form-control button-back button-back--status">Témoignages rejetés</a>
    </div>
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
        foreach ($testimonials as $testimonial) {
            $buttonStr='';
            if (isset($_GET['status'])){
                if ($_GET['status']== 'APPROVED'){
                    $buttonStr.= '<a href="" class="form-control button-back button-back--modify" onclick="rejecte('. $testimonial->id .');"><i class="far fa-times-circle"></a>';
                }else if($_GET['status']== 'REJECTED'){
                    $buttonStr.='<a href="" class="form-control button-back button-back--display" onclick="approve('. $testimonial->id .');"><i class="fas fa-check-circle"></i></a>';
                }else if($_GET['status']== 'PENDING'){
                    $buttonStr.= '<a href="" class="form-control button-back button-back--display" onclick="approve('. $testimonial->id .');"><i class="fas fa-check-circle"></i></a>'
                        . '<a href="" class="form-control button-back button-back--modify" onclick="rejecte('. $testimonial->id .');"><i class="far fa-times-circle"></i></a>';
                }
            }else{
                $buttonStr.= '<a href="" class="form-control button-back button-back--display" onclick="approve('. $testimonial->id .');"><i class="fas fa-check-circle"></i></a>'
                    . '<a href="" class="form-control button-back button-back--modify" onclick="rejecte('. $testimonial->id .');"><i class="far fa-times-circle"></i></a>';
            }

            $str = '<tr>'
                .'<td>' . $testimonial->user_name . '</td>'
                . '<td>' . $testimonial->content . '</td>'
                . '<td>Publié le ' . $testimonial->getCreatedAt() . '</td>'
                . '<td>' . $testimonial->geStringForHtmlFromStatus($testimonial->status) . '</td>'
                . '<td>';

            $str .= $buttonStr. '</td> </tr>';
            echo $str;
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
