<!DOCTYPE html>
<html>
<head>
    <title>Leaffy Installer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container py-3">
    <div class="row">
        <div class="mx-auto col-sm-8">
            <!-- form user info -->
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Leaffy - Installation</h4>
                </div>
                <div class="card-body">
                    <form id="installer_form" class="form" role="form" autocomplete="off" action="installer.php"
                          method="post">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Hôte MySQL</label>
                            <div class="col-lg-9">
                                <input id="mysqlHost" name="mysqlHost" class="form-control" type="text"
                                       placeholder="localhost">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Port MySQL</label>
                            <div class="col-lg-9">
                                <input id="mysqlPort" name="mysqlPort" class="form-control" type="number"
                                       placeholder="3036">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Nom d'utilisateur MySQL</label>
                            <div class="col-lg-9">
                                <input id="mysqlUserName" name="mysqlUserName" class="form-control" type="text"
                                       placeholder="root">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Mot de passe MySQL</label>
                            <div class="col-lg-9">
                                <input id="mysqlPass" name="mysqlPass" class="form-control" type="password" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Adresse du serveur SMTP</label>
                            <div class="col-lg-9">
                                <input id="smtp" name="smtp" class="form-control" type="text" value=""
                                       placeholder="smtp.leaffy.fr">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Port serveur SMTP</label>
                            <div class="col-lg-9">
                                <input id="smtpPort" name="smtpPort" class="form-control" type="number" value=""
                                       placeholder="587">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Nom d'utilisateur SMTP</label>
                            <div class="col-lg-9">
                                <input id="smtpUser" name="smtpUser" class="form-control" type="text" value=""
                                       placeholder="alix">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Mot de passe SMTP</label>
                            <div class="col-lg-9">
                                <input id="smtpPassword" name="smtpPassword" class="form-control" type="password"
                                       value="" placeholder="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Adresse d'envoi des mails
                                automatiques</label>
                            <div class="col-lg-9">
                                <input id="smtpFrom" name="smtpFrom" class="form-control" type="email" value=""
                                       placeholder="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Votre nom</label>
                            <div class="col-lg-9">
                                <input id="firstName" name="firstName" class="form-control" type="text"
                                       placeholder="Alix">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Votre prénom</label>
                            <div class="col-lg-9">
                                <input id="lastName" name="lastName" class="form-control" type="text"
                                       placeholder="De Haut">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Votre e-mail</label>
                            <div class="col-lg-9">
                                <input id="email" name="email" class="form-control" type="email"
                                       placeholder="email@leaffy.com">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input id="submit_button" type="submit" class="btn btn-warning btn-send"
                                       value="Envoyer">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

</script>
</body>
</html>


<?php


?>
