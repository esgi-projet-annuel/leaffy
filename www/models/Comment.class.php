<?php
declare(strict_types = 1);

namespace LeaffyMvc\Models;

use LeaffyMvc\Core\BaseSQL;
use LeaffyMvc\Core\Routing;

class Comment extends BaseSQL {

    public $status;
    public $content;
    public $user_id;
    public $post_id;

    public function __construct(){
        parent::__construct();
    }

    public function setStatus(string $status) {
        $this->status = $status;
    }

    public function setContent(string $content) {
        $this->content = $content;
    }

    public function setUserId(int $user_id) {
        $this->user_id = $user_id;
    }

    public function setPostId(int $post_id) {
        $this->post_id = $post_id;
    }

    public function getCommentForm(string $postId = null){
        return [
            "config"=>[
              "method"=>"POST",
              "action"=> Routing::getSlug("Comment","saveComment"),
              "class"=>"",
              "id"=>"",
              "submit"=>"Ajouter"],

            "data"=>[
                "post_id"=>[
                    "type"=>"hidden",
                    "value"=>$postId
                ],
                "content"=>["type"=>"textarea",
                    "placeholder"=>"Votre commentaire",
                    "required"=>false,
                    "class"=>"form-control-back",
                    "id"=>"content",
                    "minlength"=>2,
                    "maxlength"=>300,
                    "error"=>"Le commentaire doit faire entre 2 et 300 caractères"
                    ],
                ]
            ];
    }


}
