<div id="content-back" class="">
  <div class="">
    <div class="titre">
      <h2>Gestion des pages</h2>
      <a class="form-control button-back button-back--add" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Page","createPage");?>">Ajouter</a>
    </div>
  </div>
  <div class="section-table">
    <table class="table" width="100%">
        <tr class="table-head">
          <th align="left">Nom de la page</th>
          <th align="left">Date</th>
          <th width="25%"></th>
        </tr>
        <?php
            $controller = new \LeaffyMvc\Controllers\PageController();
            $pages = $controller->getAllPages();

            foreach ($pages as $page) {
                echo '<tr>'
                    . '<td>' . $page->getTitle() . '</td>'
                    . '<td>Publié le ' . $page->created_at . '</td>'
                    . '<td>'
                    . '<a href="" class="form-control button-back button-back--display" onclick="showPage('. $page->id .');">Afficher</a>'
                    . '<a href="" class="form-control button-back button-back--modify" onclick="updatePage('. $page->id .');">Modifier</a>'
                    . '<a href="" class="form-control button-back button-back--remove" onclick="deletePage('. $page->id .');">Supprimer</a>'
                    . '</td>'
                    . '</tr>';
            }
        ?>

        <script type="text/javascript">
            function deletePage(pageId) {
                $.ajax({
                    url : '/admin/deletePage',
                    type : 'POST', // Le type de la requête HTTP, ici devenu POST
                    data : 'id=' + pageId,
                });
            }

            function showPage(pageId) {
                $.ajax({
                    url : '/admin/deletePage',
                    type : 'POST', // Le type de la requête HTTP, ici devenu POST
                    data : 'id=' + pageId,
                });
            }

            function updatePage(pageId) {
                $.ajax({
                    url : '/admin/deletePage',
                    type : 'POST', // Le type de la requête HTTP, ici devenu POST
                    data : 'id=' + pageId,
                });
            }
        </script>

    </table>
  </div>
</div>
