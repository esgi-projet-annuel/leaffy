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
    <table class="table display" width="100%" id="testimonials-table">
      <thead>
        <tr class="table-head">
          <th align="left">Pseudo</th>
          <th align="left">Témoignage</th>
          <th align="left">date</th>
          <th align="left">Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td></td>
      </tr>
      </tbody>
    </table>
        <?php
        foreach ($testimonials as $testimonial) {
            $testimonial->status = $testimonial->getStringForHtmlFromDB($testimonial->status);
            $testimonial->created_at = $testimonial->getFrDate($testimonial->created_at);
            $buttonStr='';
            if (isset($_GET['status'])){
                if ($_GET['status']== 'APPROVED'){
                    $buttonStr.= '<a href="" class="form-control button-back button-back--modify" onclick="rejecte({0});"><i class="far fa-times-circle"></a>';
                }else if($_GET['status']== 'REJECTED'){
                    $buttonStr.='<a href="" class="form-control button-back button-back--display" onclick="approve({0});"><i class="fas fa-check-circle"></i></a>';
                }else if($_GET['status']== 'PENDING'){
                    $buttonStr.= '<a href="" class="form-control button-back button-back--display" onclick="approve({0});"><i class="fas fa-check-circle"></i></a>'
                        . '<a href="" class="form-control button-back button-back--modify" onclick="rejecte({0});"><i class="far fa-times-circle"></i></a>';
                }
            }else{
                $buttonStr.= '<a href="" class="form-control button-back button-back--display" onclick="approve({0});"><i class="fas fa-check-circle"></i></a>'
                    . '<a href="" class="form-control button-back button-back--modify" onclick="rejecte({0});"><i class="far fa-times-circle"></i></a>';
            }

        }
        ?>
  </div>
</div>

<script type="text/javascript">

let datas = <?php echo json_encode($testimonials); ?>;
let buttons = <?php echo json_encode($buttonStr); ?>;
    $(document).ready( function () {
        $('#testimonials-table').DataTable({
          language: {
            url: "../../../public/DataTables/language/French.json"
          },
          data: datas,
          columns: [
              { data: 'user_name' },
              { data: 'content' },
              { data: 'created_at'},
              { data: 'status'},
              {
                data: null,
                render: function ( datas, type, row ) {
                    let id = datas["id"];
                    if (!String.prototype.format) {
                        String.prototype.format = function() {
                            var args = arguments;
                            return this.replace(/{(\d+)}/g, function(match, number) {
                                return typeof args[number] != 'undefined'
                                    ? args[number]
                                    : match
                                    ;
                            });
                        };
                    }
                    return buttons.format(id);
                }
              }
          ]
        });
    } );

    function approve(testimonialId) {
        $.ajax({
            url : '/admin/approveTestimonial',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + testimonialId,
        });
    }

    function rejecte(testimonialId) {
        $.ajax({
            url : '/admin/rejectTestimonial',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + testimonialId,
        });
    }
</script>
