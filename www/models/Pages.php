<?php

class Pages extends BaseSQL {

    private $id = null;
    private $title;
    private $description;

    public function __construct(){
        parent::__construct();
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

}