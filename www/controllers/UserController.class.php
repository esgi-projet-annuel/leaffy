<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Models\User;
use LeaffyMvc\Core\Validator;
use LeaffyMvc\Core\View;
use LeaffyMvc\Services\MailConfirmationService;
use LeaffyMvc\Services\AuthenticationService;

class UserController extends AbstractController {

    public function showRegisterForm():void{
        $user = new User();
        $form = $user->getRegisterForm();
        $view = new View("createUser", "front");
        $view->assign("form", $form);
    }

    public function showUpdateForm(){
        $user = new User();
        $form = $user->getUpdateForm();
        $view = new View('settings', "back");
        $view->assign("form", $form);
    }

    public function showForgottenPasswordForm(){
        $user = new User();
        $form = $user->getForgottenPasswordForm();
        $view = new View('forgottenPassword', "front");
        $view->assign("formForgottenPassword", $form);
    }

    public function showResetPasswordForm(){
       $user = new User();
       $form = $user->getResetPasswordForm();
       $view = new View('resetPassword', "front");
       $view->assign("formResetPassword", $form);
    }

    public function sendMailToResetPassword(){
        $user = new User();
        $form = $user->getForgottenPasswordForm();

        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){
            $validator = new Validator($form,$data, false);
            $form["errors"] = $validator->errors;
            if (empty($form['errors'])){
                //Est ce que l'email existe bien en BDD
                $checkEmail= $user->findOneObjectBy(['email'=>$data['email']]);
                if (!empty($checkEmail) && $user->active == 1){
                    //Envoie du mail de confirmation
                    MailConfirmationService::instance()->sendMail('Mot de passe oublié!', 'forgottenPassword', $user);
                    $form['errors'][]= 'mail envoyé';
                }else{
                    $form['errors'][] = "le compte n'existe pas ou n'est pas encore activé";
                }
            }
        }

        $view = new View("forgottenPassword", "front");
        $view->assign("formForgottenPassword", $form);
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

            //Est ce que l'email existe deja en BDD
            $checkEmail= $user->findOneArrayBy(['email'=>$data['email']]);
            if (!empty($checkEmail)){
                $form["errors"][] = "L'adresse email renseignée existe déjà";
            }else{
                if(empty($form["errors"])){
                    $user->setProfile("CLIENT");
                    $user->setActive("0");
                    $user->setFirstname($data["firstname"]);
                    $user->setLastname($data["lastname"]);
                    $user->setEmail($data["email"]);
                    $user->setPassword($data["pwd"]);
                    //La method save s'execute dans generateToken()
                    AuthenticationService::instance()->generateToken($user);
                    isset($_SESSION["email"])?$_SESSION["email"]:$user->email;

                    //Envoie du mail de confirmation

                    MailConfirmationService::instance()->sendMail('Bienvenue!', 'register', $user);

                    $form["errors"][] =" Inscription validée! Un email de confirmation vient de vous etre envoyé !! ";
                }
            }
        }

        $view = new View("createUser", "front");
        $view->assign("form", $form);
    }

    public function updateUserBy(){
        $user = new User();
        $form = $user->getResetPasswordForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){
            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;
            if(empty($form["errors"])){
                $user->findById(intval($data['userId']));
                $newPassword = password_hash($data['pwd'], PASSWORD_DEFAULT);
                $user->updateBy(['password'=>$newPassword]);
                $form["errors"][] = 'Mot de passe modifié';
            }
        }
        $view = new View("resetPassword", "front");
        $_GET['email'] = $user->email;
        $_GET['token'] = $user->token;
        $view->assign("formResetPassword", $form);

    }

    public function updateUser():void {
        $user = new User();
        $form= $user->getUpdateForm();

        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if (isset($_SESSION['userId'])){
            $userId = intval($_SESSION['userId']);
        }else{
            $userId = intval($data['userId']);
        }

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){
            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;
            //Est ce que l'email existe deja en BDD
            $checkEmail= $user->findOneArrayBy(['email'=>$data['email']]);
            if (!empty($checkEmail)){
                $form["errors"][] = "L'adresse email renseignée existe déjà";
            }else{
                if(empty($form["errors"])){
                    $user->findById($userId);
                    $user->setFirstname($data["firstname"]);
                    $user->setLastname($data["lastname"]);
                    $user->setEmail($data["email"]);
                    $user->setPassword($data["pwd"]);
                    $user->save();
                    $_SESSION['email']= $data["email"];


                    $form["errors"][] =" Changements de vos informations enregistrés ";
                }
            }
        }

        $view = new View("settings", "back");
        $view->assign("form", $form);
    }

    public function deleteUser():void {
        $userId = intval($_POST['id']);
        $user = new User();
        $user->findById($userId);
        $user->delete();
    }

    public function getAllUsersByProfile(){
        $profile = isset($_GET['profile'])?$_GET['profile']:'CLIENT';
        $user = new User();
        $users = $user->findAllBy(['profile'=>$profile]);
        $view = new View("users", "back");
        $view->assign("users", $users);
    }

    public function changeProfile(){
        var_dump($_POST);
        $data = $_POST;
        if(!empty($data) ){
            $userId = intval($_POST['id']);
            $user = new User();
            $user->findById($userId);
            $user->setProfile($_POST['profile']);
            $user->save();
        }
    }
}
