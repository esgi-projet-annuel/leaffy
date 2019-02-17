<?php

class AuthenticationController {

    public function viewAdminLoginForm(){
        $view = new View('adminLogin', 'back');
    }

    public function authenticateAdmin(){
        $security = new Security($_POST['email']);
        $security->login( $_POST['pwd']);

    }

    public function viewUserLoginForm(){
      $user = new User();
      $form = $user->getLoginForm();

      $view = new View('userLogin', 'front');
      $view->assign("form", $form);
    }

    public function authenticateUser(){
        print "coucou";
      $view = new View('userLogin', 'front');

    }
}
