<?php
declare(strict_types = 1);

namespace LeaffyMvc\Models;

use LeaffyMvc\Core\BaseSQL;

class Testimonial extends BaseSQL{

    public $content;
    public $status;
    public $user_name;

    public function __construct(){
        parent::__construct();
    }

    public function setContent(string $content){
        $this->content = $content;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function setUserName($user_name): void
    {
        $this->$user_name = $user_name;
    }

    public function getTestimonialForm(){
        return [
            "config"=>[
              "method"=>"POST",
              "action"=> \LeaffyMvc\Core\Routing::getSlug("Testimonial","saveTestimonial"),
              "class"=>"",
              "id"=>"",
              "submit"=>"Ajouter"],

            "data"=>[
              "firstname"=>[
                "type"=>"text",
                "placeholder"=>"Votre prénom",
                "required"=>true,
                "class"=>"form-control-testimonial",
                "id"=>"firstname",
                "minlength"=>2,
                "maxlength"=>100,
                "error"=>"Le prénom doit faire entre 2 et 100 caractères"
              ],
                "lastname"=>[
                  "type"=>"text",
                  "placeholder"=>"Votre prénom",
                  "required"=>true,
                  "class"=>"form-control-testimonial",
                  "id"=>"lastname",
                  "minlength"=>2,
                  "maxlength"=>100,
                  "error"=>"Le nom doit faire entre 2 et 100 caractères"
                ],


              "content"=>["type"=>"textarea","placeholder"=>"Votre témoignage", "required"=>false, "class"=>"form-control-testimonial", "id"=>"content","minlength"=>2,"maxlength"=>800,
                "error"=>"Le témoignage doit faire entre 2 et 800 caractères"],

            ]
        ];
    }

}
