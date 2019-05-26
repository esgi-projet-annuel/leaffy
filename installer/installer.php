<?php
	$mysqlUserName = $_POST['mysqlUserName'];
	$mysqlPass = $_POST['mysqlPass'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];

	$host="localhost";

	$user="leaffy";
	$pass="leaffyP4ss";
	$db="mvcleaf"; 

    try {
        $dbh = new PDO("mysql:host=$host", $mysqlUserName, $mysqlPass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        // Create database
        $dbh->exec("CREATE DATABASE IF NOT EXISTS `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;")
        or die();


        // Connect to newly created db
        $dbh = new PDO("mysql:host=$host;dbname=mvcleaf", $mysqlUserName, $mysqlPass); 
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


        // Create schema
        $sql = file_get_contents('mvcleaf.sql');
		$dbh->exec($sql);

		$dbh = new PDO("mysql:host=$host;dbname=mvcleaf", $mysqlUserName, $mysqlPass); 
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		// Add admin user
		$adminPass = generateRandomString();
		print($adminPass);
		$hash = password_hash($adminPass, PASSWORD_DEFAULT);

		$query = "INSERT INTO User (profile, active, firstname, lastname, email, password)"
			. "VALUES ('ADMIN', '1', 'Alix', 'DE HAUT', 'dehaut.alix@test.com', :hash)";

		$statement = $dbh->prepare($query);
		$statement->bindParam('hash', $hash, PDO::PARAM_STR);
		$statement->execute();
		$statement->closeCursor();

		// $dbh->exec("INSERT INTO User (id, profile, active, firstname, lastname, email, password) 
		// 	VALUES (1, 'ADMIN', '1', 'Alix', 'DE HAUT', 'dehaut.alix@test.com', '$hash');");
		// $req->bindParam(1, $hash);
  //   	$req->execute();		



        print ' oki';



    } catch (PDOException $e) {
    	var_dump($e);
        print("DB ERROR: ". $e->getMessage());
    }

    function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
?>