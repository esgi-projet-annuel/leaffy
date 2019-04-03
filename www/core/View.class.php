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

    public function addMenu($menu , $template){
        $menuPath= "views/".$template."/menus/".$menu.".php";
        if( file_exists($menuPath)){
            include $menuPath;
        }else{
            die("Attention le fichier menu n'existe pas ".$menuPath);
        }
    }

    public function addHeader($header , $template){
        $headerPath= "views/".$template."/header/".$header.".php";
        if( file_exists($headerPath)){
            include $headerPath;
        }else{
            die("Attention le fichier header n'existe pas ".$headerPath);
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
