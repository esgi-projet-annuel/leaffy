<?php

declare(strict_types = 1);

class AuthenticationController {

    public function viewAdminLoginForm() :void{
        $logged = new View('adminLogin', 'back');
        if($logged) {
            $view = new View('home', 'backb');
        } else {
            $view = new View('userLogin', 'front');
        }
    }

    public function authenticateAdmin() :void{
        //TODO créer loginAdmin Method
        $logged = AuthenticationService::instance()->loginAdmin($_POST['email'], $_POST['pwd']);
//        $security = new Security($_POST['email']);
//        $security->login($_POST['pwd']);

    }

    public function viewUserLoginForm() :void{
      $user = new User();
      $form = $user->getLoginForm();

      $view = new View('userLogin', 'front');
      $view->assign("form", $form);
    }

    public function authenticateUser() :void{
        $user= new User();
        $form = $user->getLoginForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;

            if(empty($errors)){
                $logged = AuthenticationService::instance()->login($data['email'], $data['pwd']);
                if($logged) {
                    if (AuthenticationService::instance()->isAdmin()){
                        $view = new View('home', 'back');
                    }else{
                        $view = new View('home', 'front');
                    }
                } else {
                    $form['errors'][]= "Email ou mot de passe invalide ";
                    $view = new View('userLogin', 'front');
                    $view->assign("form", $form);
                }

            }

        }
    }

    public function userLogout() :void{
        AuthenticationService::instance()->logout('http://localhost:88/?page=1');
    }
}
