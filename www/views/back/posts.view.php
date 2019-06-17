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
        $button_modify_part1 = '<a href="'.\LeaffyMvc\Core\Routing::getSlug("Post","viewSetPost").'?id=';
        $button_modify_part2 = '" class="form-control button-back button-back--modify"><i class="fas fa-edit"></i></a>';
        $button_delete_part1 = '<a href="" class="form-control button-back button-back--remove" onclick="deletePost(';
        $button_delete_part2 =');"><i class="fas fa-trash-alt"></i></a>';
        ?>
  </div>
</div>

<script type="text/javascript">
var data = <?php echo json_encode($posts); ?>;
var button_modify_part1 = <?php echo json_encode($button_modify_part1); ?>;
var button_modify_part2 = <?php echo json_encode($button_modify_part2); ?>;
var button_delete_part1 = <?php echo json_encode($button_delete_part1); ?>;
var button_delete_part2 = <?php echo json_encode($button_delete_part2); ?>;
    $(document).ready( function () {
        $('#posts-table').DataTable({
          data: data,
          columns: [
              { data: 'title' },
              { data: 'created_at'},
              { data: 'status'},
              { data: "id" },
              {
                data: null,
                render: function ( data, type, row ) {
                  return button_modify_part1+data["id"]+button_modify_part2+button_delete_part1+data["id"]+button_delete_part2;
                }
              }
          ]
        });
    } );
    function deletePost(postId) {
        $.ajax({
            url : '/admin/deletePost',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + postId,
        });
    }

    function updatePost(postId) {
        $.ajax({
            url : '/admin/updatePost',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + postId,
        });
    }
</script>
