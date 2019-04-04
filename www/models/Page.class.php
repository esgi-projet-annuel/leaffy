<?php

declare(strict_types = 1);

class Page extends BaseSQL {

    public $title;
    public $description;

    public function __construct(){
        parent::__construct();
    }

    public function setTitle(string $title):void{
        $this->title = $title;
    }

    public function setDescription(string $description):void{
        $this->description = $description;
    }

    public function getTitle():string
    {
        return $this->title;
    }

    public function getDescription():string
    {
        return $this->description;
    }



}