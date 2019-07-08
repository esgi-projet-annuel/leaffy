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
//        TODO FABIEN remplacer texte des boutons par icones et le changer dans chaque vues (post/testimonials/comment/etc)
        //TODO ALIX changer status avec boutons
            foreach ($pages as $page) {
                $page->status = $page->getStringForHtmlFromDB($page->status);
                $page->created_at = $page->getFrDate($page->created_at);
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

                $buttonModify = '<a href="'. \LeaffyMvc\Core\Routing::getSlug("Page","getUpdateFormView").'?id={0}" class="form-control button-back button-back--modify"><i class="fas fa-edit"></i></a>';

            }
        ?>
  </div>
</div>

<script type="text/javascript">
    let datas = <?php echo json_encode($pages); ?>;
    let buttonModify = <?php echo json_encode($buttonModify); ?>;
    let buttons = <?php echo json_encode($buttonStr); ?>;
    $(document).ready( function () {
        $('#pages-table').DataTable({
            language: {
                "sProcessing":     "Traitement en cours...",
                "sSearch":         "Rechercher&nbsp;:",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst":      "Premier",
                    "sPrevious":   "Pr&eacute;c&eacute;dent",
                    "sNext":       "Suivant",
                    "sLast":       "Dernier"
                },
                "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                },
                "select": {
                    "rows": {
                        _: "%d lignes séléctionnées",
                        0: "Aucune ligne séléctionnée",
                        1: "1 ligne séléctionnée"
                    }
                }
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
    function changeStatus(pageId, pageStatus) {
        $.ajax({
            url : '/admin/changePageStatus',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : {id: pageId,
                status: pageStatus}
        });
    }
</script>
