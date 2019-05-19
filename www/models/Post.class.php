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

    public function getPostForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=> \LeaffyMvc\Core\Routing::getSlug("Post","savePost"),
                "class"=>"",
                "id"=>"",
                "submit"=>"Enregistrer"],
            "data"=>[
                "Titre"=>[
                    "type"=>"text",
                    "placeholder"=>"Titre de l'article",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"title",
                    "minlength"=>2,
                    "maxlength"=>100,
                    "error"=>"Le titre doit faire entre 2 et 100 caractères"
                ],
                "Shortdescription"=>["type"=>"text","placeholder"=>"Description courte", "required"=>false, "class"=>"form-control-back", "id"=>"Shortdescription","minlength"=>2,"maxlength"=>150,
                    "error"=>"La description doit faire entre 2 et 150 caractères"],
                "Content"=>["type"=>"textarea","placeholder"=>"Contenu", "required"=>false, "class"=>"form-control-back", "id"=>"content","minlength"=>2,"maxlength"=>5000,
                    "error"=>"La description doit faire entre 2 et 5000 caractères"],
                "bannerImg"=>["type"=>"file","placeholder"=>"Image principale", "required"=>false, "class"=>"form-control-back", "bannerImg"=>"job","minlength"=>0,"maxlength"=>500,
                    "error"=>"L'image n'est pas valide'"],
            ]
        ];
    }

}
