<?php

class Media extends BaseSQL {

    private $id= null;
    private $type;
    private $path;
    private $created_at;
    private $updated_at;

    public function __construct(){
        parent::__construct();
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function setType(string $type){
        $this->type = $type;
    }

    public function setPath(string $path){
        $this->path = $path;
    }

}