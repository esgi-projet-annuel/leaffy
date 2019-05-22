<div id="content-back" class="">
  <div class="">
    <div class="titre">
      <h2>Gestion des articles</h2>
      <a class="form-control button-back button-back--add" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Post","createPost");?>">Ajouter</a>
    </div>
  </div>
  <div class="section-table">
    <table class="table" width="100%">
        <tr class="table-head">
          <th align="left">Titre</th>
          <th align="left">Date</th>
          <th align="left">Status</th>
          <th width="25%"></th>
        </tr>
            <?php
                $controller = new \LeaffyMvc\Controllers\PostController();
                $posts = $controller->getAllPosts();

                foreach ($posts as $post) {
                    echo '<tr>'
                        . '<td>' . $post->title . '</td>'
                        . '<td>Publié le ' . $post->created_at . '</td>'
                        . '<td>' . $post->status . '</td>'
                        . '<td>'
//                        . '<a href="" class="form-control button-back button-back--display" onclick="showPost('. $post->id .');">Afficher</a>'
                        . '<a href="" class="form-control button-back button-back--modify" onclick="updatePost('. $post->id .');">Modifier</a>'
                        . '<a href="" class="form-control button-back button-back--remove" onclick="deletePost('. $post->id .');">Supprimer</a>'
                        . '</td>'
                        . '</tr>';
                }
            ?>
    </table>
  </div>
</div>

<script type="text/javascript">
    function deletePost(postId) {
        $.ajax({
            url : '/admin/deletePost',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + postId,
        });
    }

    function showPost(postId) {
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

