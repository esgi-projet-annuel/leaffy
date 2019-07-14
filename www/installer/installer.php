<?php


try {
    $installer = new Installer(
        $_POST['mysqlHost'],
        $_POST['mysqlPort'],
        $_POST['mysqlUserName'],
        $_POST['mysqlPass'],
        $_POST['smtp'],
        $_POST['smtpPort'],
        $_POST['smtpUser'],
        $_POST['smtpPassword'],
        $_POST['smtpFrom'],
        $_POST['firstName'],
        $_POST['lastName'],
        $_POST['email']
    );
    $installer->run();
} catch (Exception $e) {
    print("Une erreur est survenue lors de l'installation : " . $e->getMessage());
}

class Installer
{
    private $mysqlHost;
    private $mysqlPort;
    private $mysqlUserName;
    private $mysqlPass;
    private $smtp;
    private $smtpPort;
    private $smtpUser;
    private $smtpPassword;
    private $smtpFrom;
    private $firstName;
    private $lastName;
    private $email;

    private $dbuser = "leaffy";
    private $dbname = "mvcleaf";
    private $dbpass = "leaffyP4ss";

    public function __construct(
        $mysqlHost,
        $mysqlPort,
        $mysqlUserName,
        $mysqlPass,
        $smtp,
        $smtpPort,
        $smtpUser,
        $smtpPassword,
        $smtpFrom,
        $firstName,
        $lastName,
        $email)
    {
        $this->mysqlHost = $mysqlHost;
        $this->mysqlPort = $mysqlPort;
        $this->mysqlUserName = $mysqlUserName;
        $this->mysqlPass = $mysqlPass;
        $this->smtp = $smtp;
        $this->smtpPort = $smtpPort;
        $this->smtpUser = $smtpUser;
        $this->smtpPassword = $smtpPassword;
        $this->smtpFrom = $smtpFrom;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public function run()
    {
        $this->createDatabaseAndUser();
        $this->sourceDatabase();
        $this->prepareConfigFile();
    }

    private function createDatabaseAndUser()
    {
        $dbh = new PDO("mysql:host=$this->mysqlHost;port=$this->mysqlPort", $this->mysqlUserName, $this->mysqlPass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        // Create database
        $dbh->exec("CREATE DATABASE IF NOT EXISTS `" . $this->dbname . "`;
                CREATE USER '" . $this->dbuser . "'@'localhost' IDENTIFIED BY '" . $this->dbpass . "';
                GRANT ALL PRIVILEGES ON `" . $this->dbname . ".* TO '" . $this->dbuser . "'@'localhost';
                FLUSH PRIVILEGES;")
        or die();
    }

    private function sourceDatabase()
    {
        // Connect to newly created db
        $dbh = new PDO("mysql:host=$this->mysqlHost;dbname=" . $this->dbname . ";port=$this->mysqlPort", $this->mysqlUserName, $this->mysqlPass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


        // Create schema
        $sql = file_get_contents('mvcleaf.sql');
        $dbh->exec($sql);

        $dbh = new PDO("mysql:host=$this->mysqlHost;dbname=" . $this->dbname . ";port=$this->mysqlPort", $this->mysqlUserName, $this->mysqlPass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        // Add admin user
        $adminPass = $this->generateRandomString();
        $hash = password_hash($adminPass, PASSWORD_DEFAULT);

        $query = "INSERT INTO User (profile, active, firstname, lastname, email, password)"
            . "VALUES ('ADMIN', '1', :firstName, :lastName, :email, :hash)";

        $statement = $dbh->prepare($query);
        $statement->bindParam('hash', $hash, PDO::PARAM_STR);
        $statement->bindParam('email', $this->email, PDO::PARAM_STR);
        $statement->bindParam('firstName', $this->firstName, PDO::PARAM_STR);
        $statement->bindParam('lastName', $this->lastName, PDO::PARAM_STR);
        $statement->execute();
        $statement->closeCursor();

        // ON renvoie le mot de pass admin a l'utilisateur
        print($adminPass);
    }

    private function prepareConfigFile()
    {
        $configFile = fopen($_SERVER['DOCUMENT_ROOT'] . "/conf.inc.php", "w") or die("Unable to open file!");
        $content = "<?php \n";
        $content .= "define(\"DBDRIVER\", \"mysql\");\n";
        $content .= "define(\"DBHOST\", \"$this->mysqlHost\");\n";
        $content .= "define(\"DBPORT\", \"$this->mysqlPort\");\n";
        $content .= "define(\"DBNAME\", \"$this->dbname\");\n";
        $content .= "define(\"DBUSER\", \"$this->dbuser\");\n";
        $content .= "define(\"DBPWD\", \"$this->dbpass\");\n";
        $content .= "define(\"SMTP_SERVER\", \"$this->smtp\");\n";
        $content .= "define(\"SMTP_FROM\", \"$this->smtpFrom\");\n";
        $content .= "define(\"SMTP_USER\", \"$this->smtpUser\");\n";
        $content .= "define(\"SMTP_PASSWORD\", \"$this->smtpPassword\");\n";
        $content .= "define(\"SMTP_PORT\", $this->smtpPort);\n";

        fwrite($configFile, $content);
        fclose($configFile);
    }


    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
