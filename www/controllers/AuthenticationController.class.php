<?php

class AuthenticationController {

    public function authenticateAdmin(){
        var_dump($_POST);
    }

    public function loginAdmin(){
        $view = new View('adminLogin', 'back');
    }

    public function authenticateUser(){
        $view = new View('userLogin', 'front');
    }
}