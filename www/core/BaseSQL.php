<?php

class BaseSQL{

    private $pdo;
    private $table;

    public function __construct(){
        try{
            $this->pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
        }catch(Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }

        $this->table = get_called_class();
    }
}