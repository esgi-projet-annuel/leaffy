<?php

declare(strict_types = 1);

class BaseSQL{

    public $id = null;
    private $table;
    private $pdo;


    public function __construct(){
        try{
            $this->pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
        }catch(Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }
        $this->table = get_called_class();
    }

    public function setId(int $id) :void{
        $this->id = $id;
    }

    private function prepareQuery(array $findBy):PDOStatement{
        $sqlWhere = [];
        foreach ($findBy as $key => $value) {
            $sqlWhere[]=$key."=:".$key;
        }
        $sql = "SELECT * FROM ".$this->table." WHERE ".implode(" AND ", $sqlWhere).";";
        $query = $this->pdo->prepare($sql);
        return $query;
    }

    public function findOneObjectBy(array $findBy):?object {
        $query= $this->prepareQuery($findBy);
        //modifier l'objet $this avec le contenu de la bdd
        $query->setFetchMode( PDO::FETCH_INTO, $this);

        $query->execute($findBy);
        $queryResult = $query->fetch();
        return $queryResult;
    }

    public function findOneArrayBy(array $findBy):?array {
        $query= $this->prepareQuery($findBy);
        //on retourne un simple table php
        $query->setFetchMode(PDO::FETCH_ASSOC);

        $query->execute($findBy);
        $queryResult =$query->fetch();
        return ($queryResult == false)?null:$queryResult;
    }

    public function findAllBy(array $findBy):array {
        $query= $this->prepareQuery($findBy);
        $query->execute($findBy);
        return $query->fetchAll(PDO::FETCH_CLASS, $this->table);
    }

    public function save() :void{
        $reflect = new ReflectionClass($this);
        $properties = $reflect->getProperties();

        $propertiesValue = [];
        foreach ($properties as $property) {
            if($property->isPrivate() || $property->isProtected()) {
                $property->setAccessible(true);
            }
            $key= $property->getName();
            $value= $property->getValue($this);
            $propertiesValue[$key]= $value;
        }

        if($this->id == null){
            //INSERT
            //array_keys($properties) -> [id, firstname, lastname, email]
            $sql ="INSERT INTO ".$this->table." ( ".
                implode(",", array_keys($propertiesValue) ) .") VALUES ( :".
                implode(",:", array_keys($propertiesValue) ) .")";

            $query = $this->pdo->prepare($sql);
            echo "<pre>";
            var_dump($query);
            var_dump($propertiesValue);
            echo "</pre>";
            $query->execute( $propertiesValue );

        } else {
            //UPDATE
            $sqlUpdate = [];
            foreach ($propertiesValue as $key => $value) {
                if( $key != "id")
                    $sqlUpdate[]=$key."=:".$key;
            }

            $sql ="UPDATE ".$this->table." SET ".implode(",", $sqlUpdate)." WHERE id=:id";

            $query = $this->pdo->prepare($sql);
            $query->execute( $propertiesValue );
        }
    }
}