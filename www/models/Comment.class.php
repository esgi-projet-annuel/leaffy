<?php

class Comment extends BaseSQL {

    private $id = null;
    private $status;
    private $content;
    private $uder_id;
    private $post_id;

    public function __construct(){
        parent::__construct();
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function setStatus(string $status) {
        $this->status = $status;
    }

    public function setContent(string $content) {
        $this->content = $content;
    }

    public function setUderId(int $uder_id) {
        $this->uder_id = $uder_id;
    }

    public function setPostId(int $post_id) {
        $this->post_id = $post_id;
    }


}