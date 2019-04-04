<?php

declare(strict_types = 1);

class Testimonial extends BaseSQL{

    private $id= null;
    private $content;
    private $user_id;

    public function __construct(){
        parent::__construct();
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function setContent(string $content){
        $this->content = $content;
    }


    public function setUserId(int $user_id){
        $this->user_id = $user_id;
    }

}