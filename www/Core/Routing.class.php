<?php
declare(strict_types = 1);

namespace LeaffyMvc\Core;

use PDO;

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
            $controllerPath = "/Controllers/".$controller.".class.php";

        }else{
            // Routes dynamiques (pages)
            // Remove first /
            $slug = str_replace('/','',$slug);
            $slug = str_replace('_',' ',$slug);

            $pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME.";port=".DBPORT,DBUSER,DBPWD);
            $stmt = $pdo->query("SELECT id FROM Page WHERE status = 'PUBLISHED' AND title='".$slug."'");
            $id = $stmt->fetch();

            if($id != false) {
                $_GET['page'] = $id[0];
                return ["controller"=>"PageController", "methodAction"=>"showFrontPage", "controllerPath" =>"/Controllers/PageController.class.php"];
            } else {
                return ["controller"=>null, "methodAction"=>null,"controllerPath"=>null ];
            }
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
