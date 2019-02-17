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

    public function addUser() {
        print "user add ";
        $view = new View("createUser", "front");
//        $user->setEmail("dehaut.alix@gmail.com");
//        $user->setFirstname("Alix");
//        $user->setLastname("De Haut");
//        $user->setLogin("admin");
//        $user->setPassword("udpdt");
//        $user->setProfession('dev');
//        $user->setProfile("ADMIN");
//
//        $user->save();

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
                $user->save();
            }



        }

        $v = new View("addUser", "front");
        $v->assign("form", $form);
    }

    public function saveUser(){

    }

    public function editUser(){

    }

    public function deleteUser(){

    }

}
