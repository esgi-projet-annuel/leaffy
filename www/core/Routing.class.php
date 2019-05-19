<?php
declare(strict_types = 1);

namespace LeaffyMvc\Core;

class Routing {

    public static $routeFile = "routes.yml";

    public static function getRoute($slug){

        //récuperer toutes les routes dans le fichier yml
        $routes = yaml_parse_file(self::$routeFile);
        if( isset($routes[$slug])){
            if(empty($routes[$slug]["controller"]) || empty($routes[$slug]["action"])){
                die("Il y methodAction une erreur dans le fichier routes.yml");
            }
            $controller = ucfirst($routes[$slug]["controller"])."Controller";
            $methodAction = $routes[$slug]["action"];
            $controllerPath = "/controllers/".$controller.".class.php";

        }else{
            return ["controller"=>null, "methodAction"=>null,"controllerPath"=>null ];
        }

        return ["controller"=>$controller, "methodAction"=>$methodAction,"controllerPath"=>$controllerPath ];
    }


    public static function getSlug($controller, $methodAction){
        $routes = yaml_parse_file(self::$routeFile);

        foreach ($routes as $slug => $controllerAndAction) {

            if( !empty($controllerAndAction["controller"]) &&
                !empty($controllerAndAction["action"]) &&
                $controllerAndAction["controller"] == $controller &&
                $controllerAndAction["action"] == $methodAction){
                return $slug;
            }

        }
        return null;

    }
}