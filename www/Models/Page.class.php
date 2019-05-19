<?php
declare(strict_types = 1);

namespace LeaffyMvc\Models;

use LeaffyMvc\Core\BaseSQL;

class Page extends BaseSQL {

    public $title;
    public $status;
    public $meta_description;
    public $menu_id;

    public function __construct(){
        parent::__construct();
    }

    public function setTitle(string $title):void{
        $this->title = $title;
    }

    public function setStatus(string $status):void
    {
        $this->status = $status;
    }

    public function setDescription(string $description):void{
        $this->meta_description = $description;
    }

    public function setMenuId(int $menu_id): void
    {
        $this->menu_id = $menu_id;
    }

    public function getTitle():string
    {
        return $this->title;
    }

    public function getStatus():string
    {
        return $this->status;
    }

    public function getDescription():string
    {
        return $this->meta_description;
    }

    public function getMenuId():int
    {
        return $this->menu_id;
    }


}