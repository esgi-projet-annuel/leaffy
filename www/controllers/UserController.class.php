<?php

declare(strict_types = 1);

class UserController {


//    public function login(){
//        $view = new View("userLogin", "front");
//
//    }

    public function createUser():void{
        $user = new User();
        $form = $user->getRegisterForm();
        $view = new View("createUser", "front");
        $view->assign("form", $form);
    }

    public function saveUser():void{
        $user = new User();
        $form = $user->getRegisterForm();

        //Est ce qu'il y a des données dans POST ou GET($form["config"]["method"])
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){
            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;
            if(empty($errors)){
                $user->setFirstname($data["firstname"]);
                $user->setLastname($data["lastname"]);
                $user->setEmail($data["email"]);
                $user->setPassword($data["pwd"]);
                $user->setProfile("CLIENT");
                $user->save();
                isset($_SESSION["email"])?$_SESSION["email"]:$user->email;
            }
        }
        $view = new View("createUser", "front");
        $view->assign("form", $form);
    }

    public function editUser():void{

    }

    public function deleteUser():void{
        // TODO confirmation de suppression

    }

}
