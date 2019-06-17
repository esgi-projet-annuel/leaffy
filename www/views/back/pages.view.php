<div id="content-back" class="">
  <div class="">
    <div class="titre">
      <h2>Gestion des pages</h2>
      <a class="form-control button-back button-back--add" href="<?php echo \LeaffyMvc\Core\Routing::getSlug("Page","createPage");?>">Ajouter</a>
    </div>
<!--      TODO FABIEN faire de beaux boutons ^^-->
      <div class="group-button">
          <a href="/admin/listPages?status=DRAFT" class="form-control button-back button-back--status">Brouillons</a>
          <a href="/admin/listPages?status=PUBLISHED" class="form-control button-back button-back--status">Pages publiées</a>
          <a href="/admin/listPages?status=WITHDRAWN" class="form-control button-back button-back--status">Pages archivées</a>
      </div>
  </div>
  <div class="section-table">
    <table class="table display" width="100%" id="pages-table">
      <thead>
        <tr class="table-head">
          <th align="left">Nom de la page</th>
          <th align="left">Crée le </th>
          <th align="left">Modifiée le </th>
          <th align="left">Status de la page</th>
          <th width="25%"></th>
        </tr>
      </thead>
        <?php
//        TODO FABIEN remplacer texte des boutons par icones et le changer dans chaque vues (post/testimonials/comment/etc)
        //TODO ALIX changer status avec boutons
        $niec= 'WITHDRAWN';
            foreach ($pages as $page) {
                $buttonStr='';
                if (isset($_GET['status'])){
                    if ($_GET['status']== 'PUBLISHED'){
                        $buttonStr.= '<a href="" class="form-control button-back button-back--archive" onclick="changeStatus('. $page->id.',\'WITHDRAWN\');"><i class="fas fa-archive"></i></a>';
                    }else if($_GET['status']== 'WITHDRAWN'){
                        $buttonStr.='<a href="" class="form-control button-back button-back--publish" onclick="changeStatus('. $page->id.',\'PUBLISHED\');"><i class="fas fa-check-square"></i></a>';
                    }else if($_GET['status']== 'DRAFT'){
                        $buttonStr.= '<a href="" class="form-control button-back button-back--publish" onclick="changeStatus('. $page->id.',\'PUBLISHED\');"><i class="fas fa-check-square"></i></a>'
                            . '<a href="" class="form-control button-back button-back--archive" onclick="changeStatus('. $page->id.',\'WITHDRAWN\');"><i class="fas fa-archive"></i></a>';
                    }
                }else{
                    $buttonStr.= '<a href="" class="form-control button-back button-back--publish" onclick="changeStatus('. $page->id.',\'PUBLISHED\');"><i class="fas fa-check-square"></i></a>'
                        . '<a href="" class="form-control button-back button-back--archive" onclick="changeStatus('. $page->id.',\'WITHDRAWN\');"><i class="fas fa-archive"></i></a>';
                }

                $str = '<tbody><tr class="tr">';
                $str .= '<td class="td">' . $page->getTitle() . '</td>';
                $str .= '<td class="td">' . $page->created_at . '</td>';
                $str .= '<td class="td">' . $page->updated_at . '</td>';
                $str .= '<td class="td">' . $page->geStringForHtmlFromStatus($page->status) . '</td>';
                $str .= '<td class="td">';
                $str .= '<a href="'. \LeaffyMvc\Core\Routing::getSlug("Page","getUpdateFormView").'?id='.$page->id.'" class="form-control button-back button-back--modify" onclick="updatePage('. $page->id .');"><i class="fas fa-edit"></i></a>';
                $str .= '<a href="" class="form-control button-back button-back--remove" onclick="deletePage('. $page->id .');"><i class="fas fa-trash-alt"></i></a>';
                $str .= $buttonStr. '</td> </tr></tbody>';
                echo $str;
            }
        ?>
    </table>
  </div>
</div>

<script type="text/javascript">
    $(document).ready( function () {
        $('#pages-table').DataTable();
    } );
    function deletePage(pageId) {
        $.ajax({
            url : '/admin/deletePage',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : 'id=' + pageId,
        });
    }
    function changeStatus(pageId, pageStatus) {
        $.ajax({
            url : '/admin/changeStatus',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : {id: pageId,
                status: pageStatus}
        });
    }
</script>
