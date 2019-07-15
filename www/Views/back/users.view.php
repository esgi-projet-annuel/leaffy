<div id="content-back" class="">
    <div class="">
        <div class="titre">
            <h2>Gestion des utilisateurs</h2>
        </div>
        <div class="group-button">
            <a href="/admin/listUsers?profile=CLIENT" class="form-control button-back button-back--status">Abonnés</a>
            <a href="/admin/listUsers?profile=EDITOR" class="form-control button-back button-back--status">Editeurs</a>
        </div>
    </div>
    <div class="section-table">
        <table class="table display" width="100%" id="users-table">
            <thead>
            <tr class="table-head">
                <th align="left">Prénom</th>
                <th align="left">Nom</th>
                <th align="left">Email</th>
                <th align="left">Abonné depuis le </th>
                <th align="left">Rôle</th>
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
        foreach ($users as $user) {
            $user->profile = $user->getStringForHtmlFromDB($user->profile);
            $user->created_at = $user->getFrDate($user->created_at);
        }
        $selectButton = <<<EOF
            <select class="profileSelect" id="profileSelect{0}" onchange="changeProfile('{0}');">
                <option value="">Mettre à jour le rôle de l'utilisateur</option>
                <option value="CLIENT">Abonné</option>
                <option value="EDITOR">Editeur</option>
            </select>
EOF;
        ?>
    </div>
</div>

<script type="text/javascript">
    let datas = <?php echo json_encode($users); ?>;
    let selectButton = <?php echo json_encode($selectButton); ?>;
    $(document).ready( function () {
        $('#users-table').DataTable({
            language: {
              url: "../../../public/DataTables/language/French.json"
            },
            data: datas,
            columns: [
                { data: 'firstname' },
                { data: 'lastname'},
                { data: 'email'},
                { data: 'created_at' },
                { data: 'profile' },
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
    function changeProfile(userId) {
        let selectValue = document.getElementById("profileSelect"+userId).value;
        $.ajax({
            url : '/admin/changeUserProfile',
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            data : {id: userId,
                profile: selectValue}
        });
    }
</script>
