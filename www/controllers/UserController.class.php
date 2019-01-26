<?php

class UserController {

    public function login(){
        $view = new View("userLogin", "front");

    }

    public function createUser() {
        $view = new View("createUser", "front");
//        $user = new User();
//        $user->setEmail("dehaut.alix@gmail.com");
//        $user->setFirstname("Alix");
//        $user->setLastname("De Haut");
//        $user->setLogin("admin");
//        $user->setPassword("udpdt");
//        $user->setProfile(1);
//
//        $user->save();
    }

}