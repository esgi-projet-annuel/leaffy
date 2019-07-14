<?php
declare(strict_types = 1);

namespace LeaffyMvc\Models;

use LeaffyMvc\Core\BaseSQL;

class Category extends BaseSQL{

  public $name;

  public function __construct(){
      parent::__construct();
  }


  public function setName(string $name) {
      $this->name = $name;
  }

  public function getCategoryForm(){
      return [
          "config"=>[
            "method"=>"POST",
            "action"=> \LeaffyMvc\Core\Routing::getSlug("Category","saveCategory"),
            "class"=>"",
            "id"=>"",
            "submit"=>"Ajouter"],

          "data"=>[
              "name"=>[
                  "type"=>"text",
                  "placeholder"=>"Nom de la catégorie",
                  "labelName"=>"Nom de la catégorie",
                  "required"=>false,
                  "class"=>"form-control-back",
                  "id"=>"category",
                  "minlength"=>2,
                  "maxlength"=>30,
                  "error"=>"La catégorie doit faire entre 2 et 30 caractères"
                  ],
              ]
          ];
  }


}
