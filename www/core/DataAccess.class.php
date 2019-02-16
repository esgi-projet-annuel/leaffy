<?php

class DataAccess {

    private static $instance = null;
    private $pdo;

    private function __construct(){
        try{
            $this->pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
        }catch(Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }
    }

    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new DataAccess();
        }
        return self::$instance;
    }

    public function findOneById(string $tableName, int $id){
        $sql = " SELECT * FROM ".$tableName." WHERE id = ?;";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(1, $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch();
    }

    public function findOneBy(string $tableName, array $findByArray){
        $sqlWhere = [];
        foreach ($findByArray as $key => $value) {
            $sqlWhere[]=$key."=:".$key;
        }

        $sql = "SELECT * FROM ".$tableName." WHERE ".implode(" AND ", $sqlWhere).";";
        $query = $this->pdo->prepare($sql);
        $query->execute($findByArray);
        $query->setFetchMode( PDO::FETCH_ASSOC);
        return $query->fetch();
    }

    // findAllBy()

    //findAll()
}