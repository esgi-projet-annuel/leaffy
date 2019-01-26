<?php

class BaseSQL{

    private $id = null;
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

    protected function setId(int $id)
    {
        $this->id = $id;
    }


    public function save(){
        $reflect = new ReflectionClass($this);
        $properties = $reflect->getProperties();



        //Array ( [id] => [firstname] => Yves [lastname] => SKRZYPCZYK [email] => y.skrzypczyk@gmail.com [pwd] => $2y$10$tdmxlGf.zP.3dd7K/kRtw.jzYh2CnSbFuXaUkDNl3JtDJ05zCI7AG [role] => 1 [status] => 0 [pdo] => PDO Object ( ) [table] => Users )
        //Array ( [id] => [firstname] => Yves [lastname] => SKRZYPCZYK [email] => y.skrzypczyk@gmail.com [pwd] => $2y$10$tdmxlGf.zP.3dd7K/kRtw.jzYh2CnSbFuXaUkDNl3JtDJ05zCI7AG [role] => 1 [status] => 0)
        $dataChild = array_diff_key($dataObject, get_class_vars(get_class()));
        if( is_null($dataChild["id"])){
            //INSERT
            //array_keys($dataChild) -> [id, firstname, lastname, email]
            $sql ="INSERT INTO ".$this->table." ( ".
                implode(",", array_keys($dataChild) ) .") VALUES ( :".
                implode(",:", array_keys($dataChild) ) .")";

            $query = $this->pdo->prepare($sql);
            $query->execute( $dataChild );

        }else{
            //UPDATE
            $sqlUpdate = [];
            foreach ($dataChild as $key => $value) {
                if( $key != "id")
                    $sqlUpdate[]=$key."=:".$key;
            }

            $sql ="UPDATE ".$this->table." SET ".implode(",", $sqlUpdate)." WHERE id=:id";

            $query = $this->pdo->prepare($sql);
            $query->execute( $dataChild );

        }

    }
}