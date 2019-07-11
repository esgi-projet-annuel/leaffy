<div id="content-back" class="">
  <div class="">
    <div class="titre">
      <h2>Gestion des articles</h2>
      <a class="form-control button-back button-back--add" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Post","createPost");?>">Ajouter</a>
    </div>
      <div class="group-button">
          <a href="/admin/listPosts?status=DRAFT" class="form-control button-back button-back--status">Brouillons</a>
          <a href="/admin/listPosts?status=PUBLISHED" class="form-control button-back button-back--status">Articles publiés</a>
          <a href="/admin/listPosts?status=WITHDRAWN" class="form-control button-back button-back--status">Articles archivés</a>
      </div>
  </div>
  <div class="section-table">
    <table class="table display" width="100%" id="posts-table">
      <thead>
        <tr class="table-head">
          <th align="left">Titre</th>
          <th align="left">Date</th>
          <th align="left">Status</th>
          <th></th>
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
        $buttonModify = '<a href="'.\LeaffyMvc\Core\Routing::getSlug("Post","getUpdateFormView").'?id= {0} " class="form-control button-back button-back--modify"><i class="fas fa-edit"></i></a>';

        foreach ($posts as $post) {
            $post->status = $post->getStringForHtmlFromDB($post->status);
            $post->created_at = $post->getFrDate($post->created_at);
            $buttonStr='';
            if (isset($_GET['status'])){
                if ($_GET['status']== 'PUBLISHED'){
                    $buttonStr.= '<a href="" class="form-control button-back button-back--archive" onclick="changeStatus(\'{0}\',\'WITHDRAWN\');"><i class="fas fa-archive"></i></a>';
                }else if($_GET['status']== 'WITHDRAWN'){
                    $buttonStr.='<a href="" class="form-control button-back button-back--publish" onclick="changeStatus(\'{0}\',\'PUBLISHED\');"><i class="fas fa-check-square"></i></a>';
                }else if($_GET['status']== 'DRAFT'){
                    $buttonStr.= '<a href="" class="form-control button-back button-back--publish" onclick="changeStatus(\'{0}\',\'PUBLISHED\');"><i class="fas fa-check-square"></i></a>'
                        . '<a href="" class="form-control button-back button-back--archive" onclick="changeStatus(\'{0}\',\'WITHDRAWN\');"><i class="fas fa-archive"></i></a>';
                }
            }else{
                $buttonStr.= '<a href="" class="form-control button-back button-back--publish" onclick="changeStatus(\'{0}\',\'PUBLISHED\');"><i class="fas fa-check-square"></i></a>'
                    . '<a href="" class="form-control button-back button-back--archive" onclick="changeStatus(\'{0}\',\'WITHDRAWN\');"><i class="fas fa-archive"></i></a>';
            }
        }
        ?>
  </div>
</div>

<script type="text/javascript">
let datas = <?php echo json_encode($posts); ?>;
let buttonModify = <?php echo json_encode($buttonModify); ?>;
let buttons = <?php echo json_encode($buttonStr); ?>;
    $(document).ready( function () {
        $('#posts-table').DataTable({
          language: {
            url: "../../../public/DataTables/language/French.json"
          },
          data: datas,
          columns: [
              { data: 'title' },
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
                    return buttonModify.format(id) + buttons.format(id);
                }
              }
          ]
        });
    } );

    function updatePost(postId) {
        $.ajax({
            url : '/admin/updatePost',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + postId,
        });
    }
    function changeStatus(postId, postStatus) {
        $.ajax({
            url : '/admin/changePostStatus',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : {id: postId,
                status: postStatus}
        });
    }
</script>
