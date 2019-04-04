<?php
require "conf.inc.php";
session_start();

function myAutoloader($class){
    $classPath = "core/".$class.".class.php";
    $classModel = "models/".$class.".class.php";
    $classService = "services/".$class.".class.php";
    $classController = "controllers/".$class.".class.php";
    if(file_exists($classPath)){
        include $classPath;
    }else if(file_exists($classModel)){
        include $classModel;
    }else if(file_exists($classService)) {
        include $classService;
    }else if(file_exists($classController)) {
        include $classController;
    }
}

spl_autoload_register("myAutoloader");

$slug = $_SERVER["REQUEST_URI"];

// We dont want GET parameters
$slugExploded = explode("?", $slug);
$slug = $slugExploded[0];

$routes = Routing::getRoute($slug);
extract($routes);


//vérifier l'existence du fichier et de la class controller
if( file_exists($controllerPath) ){
    include $controllerPath;
    if( class_exists($controller)){
        //instancier dynamiquement le controller
        $controllerObject = new $controller();
        //vérifier que la méthode (l'action) existe
        if( method_exists($controllerObject, $methodAction) ){
            //appel dynamique de la méthode
            $controllerObject->$methodAction();
        }else{
            die("La methode ".$methodAction." n'existe pas");
        }

    }else{
        die("La class controller ".$controller." n'existe pas");
    }
}else{
    die("Le fichier controller ".$controller." n'existe pas");
}