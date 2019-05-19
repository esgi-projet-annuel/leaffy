<?php
declare(strict_types = 1);

namespace LeaffyMvc\Models;

use LeaffyMvc\Core\BaseSQL;

class Comment extends BaseSQL {

    public $id = null;
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


}