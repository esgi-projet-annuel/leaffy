<?php
declare(strict_types = 1);

namespace LeaffyMvc\Models;

use LeaffyMvc\Core\BaseSQL;

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

    public function getTestimonialForm(){
        return [
            "config"=>[
              "method"=>"POST",
              "action"=> /*ADD ACTION SLUG ?*/"",
              "class"=>"",
              "id"=>"",
              "submit"=>"Ajouter"],

            "data"=>[
              "firstname"=>[
                "type"=>"text",
                "placeholder"=>"Votre prénom",
                "required"=>true,
                "class"=>"form-control-login",
                "id"=>"firstname",
                "minlength"=>2,
                "maxlength"=>100,
                "error"=>"Le prénom doit faire entre 2 et 100 caractères"
              ],
              "data"=>[
                "lastname"=>[
                  "type"=>"text",
                  "placeholder"=>"Votre prénom",
                  "required"=>true,
                  "class"=>"form-control-login",
                  "id"=>"lastname",
                  "minlength"=>2,
                  "maxlength"=>100,
                  "error"=>"Le nom doit faire entre 2 et 100 caractères"
                ],


              "Content"=>["type"=>"textarea","placeholder"=>"Votre témoignage", "required"=>false, "class"=>"form-control-back", "id"=>"content","minlength"=>2,"maxlength"=>800,
                "error"=>"Le témoignage doit faire entre 2 et 800 caractères"],

            ]

        ];
    }

}
