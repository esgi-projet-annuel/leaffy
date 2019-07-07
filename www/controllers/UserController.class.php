<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Models\User;
use LeaffyMvc\Core\Validator;
use LeaffyMvc\Core\View;
use LeaffyMvc\Services\MailConfirmationService;
use LeaffyMvc\Services\AuthenticationService;

class UserController extends AbstractController {

    public function createUser():void{
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
                    MailConfirmationService::instance()->sendConfirmationMail($user->email, $user->token);

                    $form["errors"][] =" Inscription validée! Un email de confirmation vient de vous etre envoyé !! ";
                }
            }
        }

        $view = new View("createUser", "front");
        $view->assign("form", $form);
    }

    public function updateUser():void {
        $userId = intval($_SESSION['userId']);
        $user = new User();
        $form= $user->getUpdateForm();
        $user->findById($userId);

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
