<div id="content-back" class="">
  <div class="">
    <div class="titre">
      <h2>Gestion des catégories</h2>
    </div>
  </div>
  <div class="section-sous-titre">
    <div class="sous-titre-category">
      <h3>Créer une catégorie</h3>
    </div>
  </div>
  <div class="section-form-category">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-12">
          <div class="">
            <?php $this->addModal("formCategory", $formCategory);?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section-table">
    <table class="table display" width="100%" id="posts-table">
      <thead>
        <tr class="table-head">
          <th align="left">Nom de la catégorie</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td align="left"></td>
      </tr>
      </tbody>
    </table>
        <?php
        $buttonModify = '<a title="Modifier" href="'.\LeaffyMvc\Core\Routing::getSlug("Post","????").'?id= {0} " class="form-control button-back button-back--modify"><i class="fas fa-edit"></i></a>';

        foreach ($categories as $categorie) {
            $buttonStr='';
            // add bouton Supprimer ?
        }

        ?>
  </div>
</div>

  <script type="text/javascript">
  let datas = <?php echo json_encode($categories); ?>;
  let buttonModify = <?php echo json_encode($buttonModify); ?>;
  // let buttons = <?php // echo json_encode($buttonStr); ?>;
    $(document).ready( function () {
        $('#posts-table').DataTable({
          language: {
            url: "../../../public/DataTables/language/French.json"
          },
          data: datas,
          columns: [
              { data: 'name' },
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
            url : '/admin/updateCategory',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + categoryId,
        });
    }
    function changeStatus(postId, postStatus) {
        $.ajax({
            url : '/admin/changeCategoryStatus',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : {id: categoryId,
                status: categoryStatus}
        });
    }
  </script>
