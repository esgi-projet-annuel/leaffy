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
          <th align="left">date de création</th>
          <th align="left">Status</th>
          <th align="left">ID</th>
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
            $testimonial->status = $testimonial->geStringForHtmlFromStatus($testimonial->status) ;
            $testimonial->created_at = $testimonial->getCreatedAt() ;
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

        }
        ?>
  </div>
</div>
<?php// var_dump($testimonials) ?>

<script type="text/javascript">

let datas = <?php echo json_encode($testimonials); ?>;
let buttonModify = <?php echo json_encode($buttonModify); ?>;
let buttons = <?php echo json_encode($buttonStr); ?>;
    $(document).ready( function () {
        $('#testimonials-table').DataTable({
          language: {
            "sProcessing":     "Traitement en cours...",
            "sSearch":         "Rechercher&nbsp;:",
            "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix":    "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
              "sFirst":      "Premier",
              "sPrevious":   "Pr&eacute;c&eacute;dent",
              "sNext":       "Suivant",
              "sLast":       "Dernier"
            },
            "oAria": {
              "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
              "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            },
            "select": {
              "rows": {
                  _: "%d lignes séléctionnées",
                  0: "Aucune ligne séléctionnée",
                  1: "1 ligne séléctionnée"
              }
            }
          },
          data: datas,
          columns: [
              { data: 'user_name' },
              { data: 'content' },
              { data: 'created_at'},
              { data: 'status'},
              { data: 'id' },
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
                    return buttonModify.format(id) + buttons.format(id);
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
