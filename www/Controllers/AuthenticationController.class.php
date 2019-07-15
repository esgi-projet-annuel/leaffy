<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;
use LeaffyMvc\Core\View;
use LeaffyMvc\Services\AuthenticationService;
use LeaffyMvc\Models\User;
use LeaffyMvc\Core\Validator;
use LeaffyMvc\Core\Routing;

class AuthenticationController extends AbstractController {

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

            $validator = new Validator($form ,$data ,false);
            $form["errors"] = $validator->errors;
            if(empty($form["errors"])){
                $logged = AuthenticationService::instance()->login($user, $data['email'], $data['pwd']);
                if($logged) {
                    if (AuthenticationService::instance()->isAdmin() || AuthenticationService::instance()->isEditor()){
                        $view = new View('home', 'back');
                    }else{
                        $view = new View('home', 'front');
                    }
                }else{
                    $form['errors'][]= "Ce compte n'est pas activé ou le mot de passe est incorrect ";
                    $view = new View('userLogin', 'front');
                    $view->assign("form", $form);
                }
            }
        else {
            $form['errors'][]= "Email ou mot de passe invalide ";
            $view = new View('userLogin', 'front');
            $view->assign("form", $form);
        }
    }
    }

    public function userLogout() :void{
        $user= new User();
        AuthenticationService::instance()->logout($user, Routing::getSlug('Page', 'showFrontPage'));
    }
}
