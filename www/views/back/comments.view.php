<div id="content-back" class="">
  <div class="">
    <div class="titre">
      <h2>Gestion des commentaires</h2>
    </div>
      <!--      TODO FABIEN visuel des boutons/liens/ce que tu veux xD-->
      <a href="/admin/listTestimonials?status=PENDING" class="form-control button-back button-back--modify">Témoignages en attente de validation</a>
      <a href="/admin/listTestimonials?status=APPROVED" class="form-control button-back button-back--modify">Témoignages validés</a>
      <a href="/admin/listTestimonials?status=REJECTED" class="form-control button-back button-back--modify">Témoignages rejetés</a>

  </div>
  <div class="section-table">
    <table class="table" width="100%" id="comments-table">
        <tr class="table-head">
          <th align="left">Auteur</th>
          <th align="left">Commentaire</th>
          <th align="left">En réponse à</th>
          <th align="left">Date</th>
          <th width="25%"></th>
        </tr>
        <tr>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td></td>
        </tr>
    </table>
    <a href="" class="form-control button-back button-back--display">Valider</a>
    <a href="" class="form-control button-back button-back--modify">Refuser</a>
    <a href="" class="form-control button-back button-back--remove">Supprimer</a>
  </div>
</div>
<script>
let datas = <?php echo json_encode($comments); ?>;
let selectButton = <?php echo json_encode($selectButton); ?>;
$(document).ready( function () {
    $('#comments-table').DataTable({
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
            { data: 'author' },
            { data: 'content'},
            { data: 'post_id'},
            { data: 'created_at' },
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
                    return selectButton.format(id);
                }
            }
        ]
    });
} );
</script>
