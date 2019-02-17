<?php

class UserController {


    public function login(){
        $view = new View("userLogin", "front");

    }

    public function createUser(){
        $user = new User();
        $form = $user->getRegisterForm();
        $view = new View("createUser", "front");
        $view->assign("form", $form);
    }

    public function saveUser() {
        print "user save ";
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
            }
        }
        $view = new View("createUser", "front");
        $view->assign("form", $form);
    }

    public function editUser(){

    }

    public function deleteUser(){

    }

}
