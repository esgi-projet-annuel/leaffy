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
        $formPwd= $user->getChangePasswordForm();
        $view = new View('settings', "back");
        $view->assign("form", $form);
        $view->assign("formPwd",$formPwd );
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
                    AuthenticationService::generateToken($user);
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

    public function updateUserBy(User $user, array $form):array{
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
            if(empty($form["errors"])){
                $user->findById($userId);
                if (isset($data['pwd'])){
                    $data['password'] = password_hash($data['pwd'], PASSWORD_DEFAULT);
                }
                $updateByArray =[];
                foreach ($data as $key => $value){
                    if ($key != 'userId' && $key != 'pwdConfirm' && $key != 'pwd'){
                        $updateByArray[$key] = $value;
                    }
                }
                $user->updateBy($updateByArray);
                $form["errors"][] = 'Mot de passe modifié';
            }
        }
        return $form;
    }

    public function changeUserInfo(){
        $user = new User();
        $formPwd= $user->getChangePasswordForm();
        $form = $user->getUpdateForm();
        $returnForm = $this->updateUserBy($user, $form);
        $view = new View('settings', "back");
        $view->assign("form", $returnForm);
        $view->assign("formPwd",$formPwd);
    }

    public function changePwd(){
        $user = new User();
        $formPwd= $user->getChangePasswordForm();
        $returnForm = $this->updateUserBy($user, $formPwd);
        $form = $user->getUpdateForm();
        $view = new View('settings', "back");
        $view->assign("form", $form);
        $view->assign("formPwd",$returnForm);
    }

    public function resetPwd(){
        $user = new User();
        $form = $user->getResetPasswordForm();
        $returnForm = $this->updateUserBy($user, $form);
        $view = new View("resetPassword", "front");
        $_GET['email'] = $user->email;
        $_GET['token'] = $user->token;
        $view->assign("formResetPassword", $returnForm);
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
//                    $user->setPassword($data["pwd"]);
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
        $this->checkAdmin();
        $userId = intval($_POST['id']);
        $user = new User();
        $user->findById($userId);
        $user->delete();
    }

    public function getAllUsersByProfile(){
        $this->checkAdmin();
        $profile = isset($_GET['profile'])?$_GET['profile']:'CLIENT';
        $user = new User();
        $users = $user->findAllBy(['profile'=>$profile]);
        $view = new View("users", "back");
        $view->assign("users", $users);
    }

    public function changeProfile(){
        $this->checkAdmin();
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
