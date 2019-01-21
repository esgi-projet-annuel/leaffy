<?php

class Menus extends BaseSQL {

    private $id;
    private $name;
    private $parent_id;
    private $page_id;

    public function __construct(){
        parent::__construct();
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setParentId(int $parent_id){
        $this->parent_id = $parent_id;
    }


    public function setPageId(int $page_id){
        $this->page_id = $page_id;
    }

}