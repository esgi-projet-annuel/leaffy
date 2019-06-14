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
    <!-- <table class="table" width="100%"> ANCIENNE VERSIONS SANS DATA TABLE
        <tr class="table-head">
          <th align="left">Titre</th>
          <th align="left">Date</th>
          <th align="left">Status</th>
          <th width="25%"></th>
        </tr>
            <?php
                /*foreach ($posts as $post) {
                    echo '<tr>'
                        . '<td>' . $post->title . '</td>'
                        . '<td>Publié le ' . $post->created_at . '</td>'
                        . '<td>' . $post->geStringForHtmlFromStatus($post->status) . '</td>'
                        . '<td>'
                        . '<a href="'.\LeaffyMvc\Core\Routing::getSlug("Post","viewSetPost").'?id='.$post->id.'" class="form-control button-back button-back--modify">Modifier</a>'
                        . '<a href="" class="form-control button-back button-back--remove" onclick="deletePost('. $post->id .');">Supprimer</a>'
                        . '</td>'
                        . '</tr>';
                } */
            ?>
    </table> -->
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
      foreach ($posts as $post) {
        $action = '<tr><td align="left">'
              . '<a href="'.\LeaffyMvc\Core\Routing::getSlug("Post","viewSetPost").'?id='.$post->id.'" class="form-control button-back button-back--modify">Modifier</a>'
              . '<a href="" class="form-control button-back button-back--remove" onclick="deletePost('. $post->id .');">Supprimer</a>'
              . '</td></tr>';

      }
      ?>
  </div>
</div>

<script type="text/javascript">
var data = <?php echo json_encode($posts); ?>;
var action = <?php echo json_encode($action); ?>;
    $(document).ready( function () {
        $('#posts-table').DataTable({
          data: data,
          columns: [
              { data: 'title' },
              { data: 'created_at'},
              { data: 'status'},
              { data: "id" },
              { data: "empty" }
          ],
          columnDefs: [ {
            targets: -1,
            data: "empty",
            defaultContent: action
          } ]
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
