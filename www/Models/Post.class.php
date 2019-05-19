<?php
declare(strict_types = 1);

namespace LeaffyMvc\Models;

use LeaffyMvc\Core\BaseSQL;

class Post extends BaseSQL{

    public $title;
    public $content;
    public $description;
    public $type;
    public $status;
    public $page_id;

    public function __construct(){
        parent::__construct();
    }


    public function setTitle(string $title):void{
        $this->title = $title;
    }


    public function setContent(string $content):void{
        $this->content = $content;
    }


    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }


    public function setStatus(string $status):void{
        $this->status = $status;
    }


    public function setPageId(int $page_id):void{
        $this->page_id = $page_id;
    }

}
