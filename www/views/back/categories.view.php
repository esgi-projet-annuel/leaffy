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
    <table class="table display" width="100%" id="categories-table">
      <thead>
        <tr class="table-head">
          <th align="left">Nom de la catégorie</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td align="left"></td>
          <td></td>
      </tr>
      </tbody>
    </table>
        <?php
            $buttonStr= '<a href="" title="delete" class="form-control button-back button-back--archive" onclick="deleteCategory(\'{0}\');"><i class="fas fa-trash"></i></a>';
        ?>
  </div>
</div>

  <script type="text/javascript">
  let datas = <?php echo json_encode($categories); ?>;
  let buttonStr = <?php echo json_encode($buttonStr); ?>;

    $(document).ready( function () {
        $('#categories-table').DataTable({
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
                    return buttonStr.format(id);
                }
              }
          ]
        });
    } );

    function deleteCategory(categoryId) {
        $.ajax({
            url : '/admin/deleteCategory',
            type : 'POST',
            data : 'id=' + categoryId,
        });
    }
  </script>
