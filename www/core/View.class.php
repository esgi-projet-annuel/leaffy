<?php

class View {

    private $view;
    private $template;
    private $data = [];

    public function __construct($view, $template="back"){
        $this->setView($view, $template);
        $this->setTemplate($template);
    }

    public function setView($view, $template){
        $viewPath = "views/".$template."/".$view.".view.php";
        if( file_exists($viewPath)){
            $this->view=$viewPath;
        }else{
            die("Attention le fichier view n'existe pas ".$viewPath);
        }
    }

    public function setTemplate($template){
        $templatePath = "views/templates/".$template.".tpl.php";
        if( file_exists($templatePath)){
            $this->template=$templatePath;
        }else{
            die("Attention le fichier template n'existe pas ".$templatePath);
        }
    }

    public function addModal($modal, $config){
      //form.mod.php
      $modalPath = "views/modals/".$modal.".mod.php";
      if( file_exists($modalPath)){
        include $modalPath;
      }else{
        die("Attention le fichier modal n'existe pas ".$modalPath);
      }
    }

    public function assign($key, $value){
		    $this->data[$key]=$value;
	 }

    public function __destruct(){
        extract($this->data);
        include $this->template;
    }
}
