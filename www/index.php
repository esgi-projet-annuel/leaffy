<?php
require "conf.inc.php";
session_start();

spl_autoload_register(function ($class) {
    $prefix = 'LeaffyMvc\\';
    $base_dir = __DIR__ . '/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.class.php';
    if (file_exists($file)) {
        require $file;
    }
});

use LeaffyMvc\Core\Routing;
use LeaffyMvc\Core\View;

$slug = $_SERVER["REQUEST_URI"];

// We dont want GET parameters
$slugExploded = explode("?", $slug);
$slug = $slugExploded[0];

$routes = Routing::getRoute($slug);
extract($routes);

$controllerPath = __DIR__ . $controllerPath;

//vérifier l'existence du fichier et de la class controller
if(file_exists($controllerPath) ){
    include $controllerPath;
    if(class_exists('LeaffyMvc\Controllers\\' . $controller)){
        //instancier dynamiquement le controller
        $fullNSControllerName = 'LeaffyMvc\Controllers\\' . $controller;
        $controllerObject = new $fullNSControllerName();
        //vérifier que la méthode (l'action) existe
        if( method_exists($controllerObject, $methodAction) ){
            //appel dynamique de la méthode
            $controllerObject->$methodAction();
        }else{
            $view= new View('404', 'errors');
//            die("La methode ".$methodAction." n'existe pas");
        }

    }else{
        $view= new View('404', 'errors');
//        die("La class controller ".$controller." n'existe pas");
    }
}else{
    if (isset($_GET['page'])){
        var_dump($_GET['page']);
    }else{
        $view= new View('404', 'errors');
//        die("Le fichier controller ".$controller." n'existe pas");
    }
}