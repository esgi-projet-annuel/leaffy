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
                $this->pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME.";port=".DBPORT,DBUSER,DBPWD);
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

        public function getMaxMenuPosition() {
            $stmt = $this->pdo->query("SELECT MAX(menu_position) FROM ".$this->table." WHERE status = 'PUBLISHED'");
            $maxId = $stmt->fetch();
            return $maxId;
        }

        public function getFrDate($date):string
        {
            return date('d-m-Y', strtotime($date));
        }

        private function prepareQuery(array $findBy, array $leftjoin=null):PDOStatement{
            $sqlWhere = [];
            foreach ($findBy as $key => $value) {
                $sqlWhere[]=$key."=:".$key;
            }
            if ($leftjoin!= null){
            $sql = "SELECT ".$this->table.".* , ".$leftjoin['table'].".".$leftjoin['fieldWanted']."  FROM ".$this->table;
            $sql .= " LEFT JOIN " .$leftjoin['table']." on ". $leftjoin['table'].".id = ".$this->table.".".$leftjoin['field'];
            }else{
                $sql = "SELECT * FROM ".$this->table;
            }

            $sql .=" WHERE ".implode(" AND ", $sqlWhere).";";
            $query = $this->pdo->prepare($sql);
            return $query;
        }
        private function prepareQueryLimit(array $findBy,array $orderBy, int $limit=null):PDOStatement{
            $sqlWhere = [];
            foreach ($findBy as $key => $value) {
                $sqlWhere[]=$key."=:".$key;
            }
            $sql = "SELECT * FROM ".$this->table;


            $sql .=" WHERE ".implode(" AND ", $sqlWhere);

            $sql .= " ORDER BY :orderBy DESC ";

            if ($limit!= null){
                $sql .= " LIMIT " .$limit.";";
            }
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

        public function findAllBy(array $findBy, array $leftjoin= null):array {
            if($leftjoin != null){
                $query= $this->prepareQuery($findBy, $leftjoin);
            }else{
                $query= $this->prepareQuery($findBy);
            }
            $query->execute($findBy);
            return $query->fetchAll(PDO::FETCH_CLASS, get_called_class());
        }

        public function findAllByLimitOrderBy(array $findBy, array $orderBy, int $limit=null):array {
            $query= $this->prepareQueryLimit($findBy, $orderBy,$limit);
            $query->execute( array('status' => $findBy['status'], 'orderBy' => $orderBy['orderBy']));
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
                    $value= $property->getValue($this);
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
                $query->execute($propertiesValue);
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

        public function updateBy(array $newData, array $where=null):void{
            //UPDATE
            $sqlUpdate = [];
            foreach ($newData as $key => $value) {
                if( $key != "id")
                    $sqlUpdate[]=$key."=:".$key;
            }
            if ($where == null){
                $sql ="UPDATE ".$this->table." SET ".implode(",", $sqlUpdate)." WHERE id=:id";
                $newData['id'] = $this->id;
                $finalData= $newData;
            }else{
                foreach ($where as $key => $value) {
                    if( $key != "id")
                        $sqlwhere[]=$key."=:".$key;
                }
                $sql ="UPDATE ".$this->table." SET ".implode(",", $sqlUpdate)." WHERE ".implode(",", $sqlwhere);
                $finalData= array_merge($newData,$where );
            }
            $query = $this->pdo->prepare($sql);
            $query->execute($finalData);
        }

        public function delete():void{
            $sql = "DELETE FROM ".$this->table.
                " WHERE id=:id;";
            $query = $this->pdo->prepare($sql);
            $query->execute(["id" => $this->id]);
        }

        public function getStringForHtmlFromDB(string $status){
            switch ($status){
                case 'PENDING':
                    return 'En attente de validation';
                    break;
                case 'APPROVED':
                    return 'Validé';
                    break;
                case 'REJECTED':
                    return 'Rejeté';
                    break;
                case 'DRAFT':
                    return 'Brouillon';
                    break;
                case 'WITHDRAWN':
                    return 'Archivé';
                    break;
                case 'PUBLISHED':
                    return 'Publié';
                    break;
                case 'CLIENT':
                    return 'Abonné';
                    break;
                case 'EDITOR':
                    return 'Editeur';
                    break;
                case 'ADMIN':
                    return 'Administrateur';
                    break;
            }

        }


    }
}
