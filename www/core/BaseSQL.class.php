<?php

class BaseSQL{

    protected $id = null;
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

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getOneBy(array $where){

        $sqlWhere = [];
        foreach ($where as $key => $value) {
            $sqlWhere[]=$key."=:".$key;
        }
        $sql = " SELECT * FROM ".$this->table." WHERE  ".implode(" AND ", $sqlWhere).";";
        $query = $this->pdo->prepare($sql);
        $query->execute( $where );
        return $query->fetch();

    }


    public function save(){
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
        echo"<pre>";
        print_r($propertiesValue);
        echo"</pre>";

        if($this->id == null){
            //INSERT
            //array_keys($properties) -> [id, firstname, lastname, email]
            $sql ="INSERT INTO ".$this->table." ( ".
                implode(",", array_keys($propertiesValue) ) .") VALUES ( :".
                implode(",:", array_keys($propertiesValue) ) .")";

            $query = $this->pdo->prepare($sql);
            $query->execute( $propertiesValue );

        } else {
            echo "AH";
        }
    }
}