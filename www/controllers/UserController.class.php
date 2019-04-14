<?php

declare(strict_types = 1);

class UserController {


//    public function login(){
//        $view = new View("userLogin", "front");
//
//    }

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

    public function editUser():void{

    }

    public function deleteUser():void{
        // TODO confirmation de suppression

    }

}
