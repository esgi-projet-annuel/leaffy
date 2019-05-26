<div id="content-back" class="">
  <div class="">
    <div class="titre">
      <h2>Gestion des pages</h2>
      <a class="form-control button-back button-back--add" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Page","createPage");?>">Ajouter</a>
    </div>
<!--      TODO FABIEN faire de beaux boutons ^^-->
      <div class="group-button">
          <a href="/admin/listPages?status=DRAFT" class="form-control button-back button-back--status">Brouillon</a>
          <a href="/admin/listPages?status=PUBLISHED" class="form-control button-back button-back--status">Publié</a>
          <a href="/admin/listPages?status=WITHDRAWN" class="form-control button-back button-back--status">Archivé</a>
      </div>
  </div>
  <div class="section-table">
    <table class="table" width="100%">
        <tr class="table-head">
          <th align="left">Nom de la page</th>
          <th align="left">Crée le </th>
          <th align="left">Modifiée le </th>
          <th align="left">Status de la page</th>
          <th width="25%"></th>
        </tr>
        <?php
            foreach ($pages as $page) {
                echo '<tr class="tr">'
                    . '<td class="td">' . $page->getTitle() . '</td>'
                    . '<td class="td">' . $page->created_at . '</td>'
                    . '<td class="td">' . $page->updated_at . '</td>'
                    . '<td class="td"> DROP DOWN STATUS</td>'
                    . '<td class="td">'
                    . '<a href="'. \LeaffyMvc\Core\Routing::getSlug("Page","getUpdateFormView").'?id='.$page->id.'" class="form-control button-back button-back--modify" onclick="updatePage('. $page->id .');">Modifier</a>'
                    . '<a href="" class="form-control button-back button-back--remove" onclick="deletePage('. $page->id .');">Supprimer</a>'
                    . '<a href="" class="form-control button-back button-back--publish";">Publier</a>'
                    . '<a href="" class="form-control button-back button-back--archive";">Archiver</a>'
                    . '</td>'
                    . '</tr>';
            }
        ?>
    </table>
  </div>
</div>

<script type="text/javascript">
    function deletePage(pageId) {
        $.ajax({
            url : '/admin/deletePage',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + pageId,
        });
    }
</script>
