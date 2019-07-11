<!DOCTYPE html>
<html>
<head>
	<title>Leaffy Installer</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
						<form id="installer_form" class="form" role="form" autocomplete="off" action="installer.php" method="post">
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Nom d'utilisateur MySQL</label>
								<div class="col-lg-9">
									<input id="mysqlUserName" name="mysqlUserName" class="form-control" type="text" placeholder="root" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Mot de passe MySQL</label>
								<div class="col-lg-9">
									<input id="mysqlPass" name="mysqlPass" class="form-control" type="password" value="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Email</label>
								<div class="col-lg-9">
									<input id="email" name="email" class="form-control" type="email" placeholder="email@provider.com" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Mot de passe</label>
								<div class="col-lg-9">
									<input id="pass" name="pass" class="form-control" type="password" value="" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-12">
									<input id="submit_button" type="submit" class="btn btn-warning btn-send" value="Envoyer">
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
