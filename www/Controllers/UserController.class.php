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
        $userId = intval($_POST['id']);
        $user = new User();
        $user->findById($userId);

        if(!empty($data) ){
            $user->setFirstname($data['firstname']);
            $user->setLastname($data['lastname']);
            $user->setEmail($data['email']);
            $user->setPassword($data['pwd']);
            if ($user->profile === 'ADMIN')
            {
                $user->setProfession($data['profession']);
                $user->setAddress($data['address']);
                $user->setZipCode($data['zipCode']);
                $user->setCity($data['city']);
                $user->setPhoneNumber($data['phoneNumber']);
            }
            // TODO comment gerer les images/photos??
            $user->save();
        }
        $view = new View("settings", "back");
    }

    public function deleteUser():void {
        $userId = intval($_POST['id']);
        $user = new User();
        $user->findById($userId);
        $user->delete();
    }

}
