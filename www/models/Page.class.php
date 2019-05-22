<?php
declare(strict_types = 1);

namespace LeaffyMvc\Models;

use LeaffyMvc\Core\BaseSQL;

class Page extends BaseSQL {

    public $title;
    public $status;
    public $meta_description;
    public $content;
    public $type;
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

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function setType($type): void
    {
        $this->type = $type;
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

    public function getContent(): string
    {
        return $this->content;
    }

    public function getType(): string
    {
        return $this->type;
    }



    public function getPageForm(){
        return [
            "config"=>[
              "method"=>"POST",
              "action"=> \LeaffyMvc\Core\Routing::getSlug("Page","savePage"),
              "class"=>"",
              "id"=>"",
              "submit"=>"Enregistrer"],

            "data"=>[
              "title"=>[
                "type"=>"text",
                "placeholder"=>"Titre de la page",
                "required"=>true,
                "class"=>"form-control-login",
                "id"=>"title",
                "minlength"=>2,
                "maxlength"=>100,
                "error"=>"Le titre doit faire entre 2 et 100 caractères"
              ],

              "description"=>[
                  "type"=>"text","placeholder"=>"Description courte",
                  "required"=>true,
                  "class"=>"form-control-back",
                  "id"=>"description",
                  "minlength"=>2,
                  "maxlength"=>150,
                "error"=>"La description doit faire entre 2 et 150 caractères"],

              "content"=>[
                  "type"=>"textarea",
                  "placeholder"=>"Contenu de la page",
                  "required"=>false,
                  "class"=>"form-control-back",
                  "id"=>"content",
                  "minlength"=>2,
                  "maxlength"=>5000,
                "error"=>"Le contenu doit faire entre 2 et 5000 caractères"],

            ]

        ];
    }

}
