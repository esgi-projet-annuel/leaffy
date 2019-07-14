<div id="content-back" class="">
  <div class="">
    <div class="titre">
      <h2>Gestion des commentaires</h2>
    </div>
      <div class="group-button">
          <a href="/admin/listComments?status=PENDING" class="form-control button-back button-back--status">Commentaires en attente de validation</a>
          <a href="/admin/listComments?status=APPROVED" class="form-control button-back button-back--status">Commentaires validés</a>
          <a href="/admin/listComments?status=REJECTED" class="form-control button-back button-back--status">Commentaires rejetés</a>
      </div>
  </div>
  <div class="section-table">
    <table class="table display" width="100%" id="comments-table">
        <thead>
        <tr class="table-head">
          <th align="left">Abonné</th>
          <th align="left">Commentaire</th>
          <th align="left">Date</th>
          <th width="25%"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td></td>
        </tr>
        </tbody>
    </table>
      <?php
      foreach ($comments as $comment) {
          $comment->status = $comment->getStringForHtmlFromDB($comment->status);
          $buttonStr='';
          if (isset($_GET['status'])){
              if ($_GET['status']== 'APPROVED'){
                  $buttonStr.= '<a href="" title="Rejeter" class="form-control button-back button-back--modify" onclick="rejecte({0});"><i class="far fa-times-circle"></a>';
              }else if($_GET['status']== 'REJECTED'){
                  $buttonStr.='<a href="" title="Approuver" class="form-control button-back button-back--display" onclick="approve({0});"><i class="fas fa-check-circle"></i></a>';
              }else if($_GET['status']== 'PENDING'){
                  $buttonStr.= '<a href="" title="Approuver" class="form-control button-back button-back--display" onclick="approve({0});"><i class="fas fa-check-circle"></i></a>'
                      . '<a href="" title="Rejeter" class="form-control button-back button-back--modify" onclick="rejecte({0});"><i class="far fa-times-circle"></i></a>';
              }
          }else{
              $buttonStr.= '<a href="" title="Approuver" class="form-control button-back button-back--display" onclick="approve({0});"><i class="fas fa-check-circle"></i></a>'
                  . '<a href="" title="Rejeter" class="form-control button-back button-back--modify" onclick="rejecte({0});"><i class="far fa-times-circle"></i></a>';
          }

      }
      ?>
  </div>
</div>
<script>
let datas = <?php echo json_encode($comments); ?>;
let buttonStr = <?php echo json_encode($buttonStr); ?>;
$(document).ready( function () {
    $('#comments-table').DataTable({
        language: {
          url: "../../../public/DataTables/language/French.json"
        },
        data: datas,
        columns: [
            { data: 'user_id' },
            { data: 'content'},
            { data: 'created_at' },
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
                    return buttonStr.format(id);
                }
            }
        ]
    });
} );

function approve(commentId) {
    console.log(commentId);
    $.ajax({
        url : '/admin/approveComment',
        type : 'POST', // Le type de la requête HTTP, ici devenu POST
        data : 'id=' + commentId,
    });
}

function rejecte(commentId) {
    console.log(commentId);
    $.ajax({
        url : '/admin/rejectComment',
        type : 'POST', // Le type de la requête HTTP, ici devenu POST
        data : 'id=' + commentId,
    });
}
</script>
