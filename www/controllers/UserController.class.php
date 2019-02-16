<?php

class UserController {


    public function login(){
        $view = new View("userLogin", "front");

    }

    public function createUser()
    {
        $user = new User();
        $form = $user->getRegisterForm();
        $view = new View("createUser", "front");
        $view->assign("form", $form);
        //        $user = new User();
        //        $user->setEmail("dehaut.alix@gmail.com");
        //        $user->setFirstname("Alix");
        //        $user->setLastname("De Haut");
        //        $user->setLogin("admin");
        //        $user->setPassword("udpdt");
        //        $user->setProfession('dev');
        //        $user->setProfile("ADMIN");
        //
        //        $user->save();
    }

    public function addUser() {
        $view = new View("createUser", "front");
//        $user = new User();
//        $user->setEmail("dehaut.alix@gmail.com");
//        $user->setFirstname("Alix");
//        $user->setLastname("De Haut");
//        $user->setLogin("admin");
//        $user->setPassword("udpdt");
//        $user->setProfession('dev');
//        $user->setProfile("ADMIN");
//
//        $user->save();
    }

    public function saveUser(){

    }

    public function editUser(){

    }

    public function deleteUser(){

    }

}
