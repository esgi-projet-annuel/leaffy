<?php

class Post extends BaseSQL{

    private $id = null;
    private $title;
    private $content;
    private $status;
    private $page_id;
    private $created_at;
    private $updated_at;

    public function __construct(){
        parent::__construct();
    }

    public function setId(int $id){
        $this->id = $id;
    }


    public function setTitle(string $title){
        $this->title = $title;
    }


    public function setContent(string $content){
        $this->content = $content;
    }


    public function setStatus(string $status){
        $this->status = $status;
    }


    public function setPageId(int $page_id){
        $this->page_id = $page_id;
    }

}