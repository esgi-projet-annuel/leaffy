<?php
declare(strict_types = 1);

namespace LeaffyMvc\Models;

use LeaffyMvc\Core\BaseSQL;

class Media extends BaseSQL {

    public $id= null;
    public $type;
    public $path;

    public function __construct(){
        parent::__construct();
    }

    public function setType(string $type){
        $this->type = $type;
    }

    public function setPath(string $path){
        $this->path = $path;
    }

}