<?php

class AuthenticationController {

    public function viewAdminLoginForm(){
        $view = new View('adminLogin', 'back');
    }

    public function authenticateAdmin(){
        var_dump($_POST);
        $sql= "SELECT * FROM User WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute([':email' => $_POST['email']]);
        $result = $query->fetchAll();
        print_r($result);
    }

    public function viewUserLoginForm(){
        $view = new View('userLogin', 'front');
    }

    public function authenticateUser(){
        $view = new View('userLogin', 'front');
    }
}