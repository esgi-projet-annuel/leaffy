<?php
declare(strict_types = 1);

namespace LeaffyMvc\Core {

    use PDOStatement;
    use Exception;
    use PDO;
    use ReflectionClass;

    class BaseSQL{

        public $id = null;
        public $created_at;
        public $updated_at;
        private $table;
        private $pdo;


        public function __construct(){
            try{
                $this->pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
            }catch(Exception $e){
                die("Erreur SQL : ".$e->getMessage());
            }
            $classWithoutNamespace = explode('\\', get_called_class());
            $class = array_pop($classWithoutNamespace);
            $this->table = $class;
        }

        public function setId(int $id) :void{
            $this->id = $id;
        }

        public function getCreatedAt():string
        {
            return date('d-m-Y', strtotime($this->created_at));
        }

        public function getUpdatedAt():string
        {
            return date('d-m-Y', strtotime($this->updated_at));
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

        public function findById(int $id):?object {
            return $this->findOneObjectBy(['id' => $id]);
        }

        public function findOneObjectBy(array $findBy):?object {
            $query= $this->prepareQuery($findBy);
            //modifier l'objet $this avec le contenu de la bdd
            $query->setFetchMode( PDO::FETCH_INTO, $this);
            $query->execute($findBy);
            $queryResult = $query->fetch();
            return ($queryResult==false)?null:$queryResult;
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
            return $query->fetchAll(PDO::FETCH_CLASS, get_called_class());
        }

        public function findAllByOrder(array $orderBy){
            $sql = "SELECT * FROM ".$this->table." ORDER BY :orderBy ;";
            $query = $this->pdo->prepare($sql);
            $query->execute($orderBy);
            return $query->fetchAll(PDO::FETCH_CLASS, get_called_class());
        }

        public function save(): void{
            $reflect = new ReflectionClass($this);
            $properties = $reflect->getProperties();
            $propertiesValue = [];
            foreach ($properties as $property) {
                if($property->name != "id") {
                    if($property->isPrivate() || $property->isProtected()) {
                        $property->setAccessible(true);
                    }
                    $key= $property->getName();
                    $value= htmlentities($property->getValue($this));
                    $propertiesValue[$key]= $value;
                }
            }

            if($this->id == null){
                //INSERT
                //array_keys($properties) -> [id, firstname, lastname, email]
                $sql ="INSERT INTO ".$this->table." ( ".
                    implode(",", array_keys($propertiesValue) ) .") VALUES ( :".
                    implode(",:", array_keys($propertiesValue) ) .")";

                $query = $this->pdo->prepare($sql);
                $res = $query->execute($propertiesValue);
                $this->id = $this->pdo->lastInsertId();

            } else {
                //UPDATE
                $sqlUpdate = [];
                foreach ($propertiesValue as $key => $value) {
                    if( $key != "id")
                        $sqlUpdate[]=$key."=:".$key;
                }
                $sql ="UPDATE ".$this->table." SET ".implode(",", $sqlUpdate)." WHERE id=:id";
                $query = $this->pdo->prepare($sql);
                $propertiesValue['id'] = $this->id;
                $query->execute($propertiesValue);
            }
        }

        public function delete():void{
            $sql = "DELETE FROM ".$this->table.
                " WHERE id=:id;";
            $query = $this->pdo->prepare($sql);
            $query->execute(["id" => $this->id]);
        }

        public function geStringForHtmlFromStatus(string $status){
            switch ($status){
                case 'PENDING':
                    return 'En attente de validation';
                    break;
                case 'APPROVED':
                    return 'Validé';
                    break;
                case 'REJECTED':
                    return 'Rejeté';
                case 'DRAFT':
                    return 'Brouillon';
                    break;
                case 'WITHDRAWN':
                    return 'Archivé';
                    break;
                case 'PUBLISHED':
                    return 'Publié';
                    break;
            }

        }
    }
}
