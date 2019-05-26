<?php
declare(strict_types = 1);

namespace LeaffyMvc\Models;

use LeaffyMvc\Core\BaseSQL;

class User extends BaseSQL {

    public $profile;
    public $active;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $token = null;

    public function __construct(){
        parent::__construct();
    }

    // SETTER
    public function setProfile(string $profile) {
        $this->profile = $profile;
    }

    public function setActive(string $active) {
        $this->active = $active;
    }

    public function setFirstname(string $firstname) {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    public function setLastname( string $lastname) {
        $this->lastname = strtoupper(trim($lastname));
    }

    public function setEmail(string $email) {
        $this->email = strtolower(trim($email));
    }

    public function setPassword(string $password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setProfession(string $profession) {
        $this->profession = trim($profession);
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function setToken(?string $token) {
        $this->token = ($token==null)?null:trim($token);
    }

    // GETTER
    public function getProfile():string {
        return $this->profile;
    }

    public function getFirstname():string{
        return $this->firstname;
    }

    public function getLastname():string{
        return $this->lastname;
    }

    public function getEmail():string{
        return $this->email;
    }

    public function getPassword():string{
        return $this->password;
    }

    public function getProfession():?string{
        return $this->profession;
    }

    public function getToken():?string {
        return $this->token;
    }


    public function getLoginForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>\LeaffyMvc\Core\Routing::getSlug("Authentication","authenticateUser"),
                "class"=>"",
                "id"=>"",
                "submit"=>"Se connecter",
                "reset"=>"Annuler" ],

            "data"=>[
                "email"=>[
                    "type"=>"email",
                    "labelName"=>"Email",
                    "placeholder"=>"Votre email",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"email",
                    "value"=>"",
                    "error"=>"L'email n'est pas valide"
                ],

                "pwd"=>[
                    "type"=>"password",
                    "labelName"=>"Mot de passe",
                    "placeholder"=>"Votre mot de passe",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"pwd",
                    "value"=>"",
                    "error"=>"Veuillez préciser un mot de passe"
                ]
            ]

        ];
    }

    public function getRegisterForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>\LeaffyMvc\Core\Routing::getSlug("User","saveUser"),
                "class"=>"",
                "id"=>"",

                "submit"=>"Enregistrer",
                "reset"=>"Annuler" ],


            "data"=>[
                "firstname"=>[
                    "type"=>"text",
                    "labelName"=>"Prénom",
                    "placeholder"=>"",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"firstname",
                    "minlength"=>2,
                    "maxlength"=>50,
                    "error"=>"Le prénom doit faire entre 2 et 50 caractères"
                ],
                "lastname"=>[
                    "type"=>"text",
                    "labelName"=>"Nom",
                    "placeholder"=>"",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"lastname",
                    "minlength"=>2,
                    "maxlength"=>100,
                    "error"=>"Le nom doit faire entre 2 et 100 caractères"],

                "email"=>[
                    "type"=>"email",
                    "labelName"=>"Email",
                    "placeholder"=>"",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"email",
                    "maxlength"=>250,
                    "error"=>"L'email n'est pas valide ou il dépasse les 250 caractères"],

                "pwd"=>[
                    "type"=>"password",
                    "labelName"=>"Mot de passe",
                    "placeholder"=>"*******",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"pwd",
                    "minlength"=>6,
                    "error"=>"Le mot de passe doit faire au minimum 6 caractères avec des minuscules, majuscules et chiffres"],

                "pwdConfirm"=>[
                    "type"=>"password",
                    "labelName"=>"Confirmation du mot de passe",
                    "placeholder"=>"Confirmation",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"pwdConfirm",
                    "confirm"=>"pwd",
                    "error"=>"Les mots de passe ne correspondent pas"
                ]
            ]
        ];
    }

    public function getUpdateForm(){
        $lastnameValue= '';
        $firstnameValue= '';
        $emailValue= '';
        if (isset($_SESSION) && !empty($_SESSION)){
            $user = new User();
            $user->findOneObjectBy(['email'=>$_SESSION['email']]);
            //var_dump($user->token);
            //var_dump($_SESSION['token']);
            if ($user->token === $_SESSION['token']){
                $lastnameValue= $user->lastname;
                $firstnameValue= $user->firstname;
                $emailValue= $user->email;
            }
        }
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>\LeaffyMvc\Core\Routing::getSlug("User","updateUser"),
                "class"=>"",
                "id"=>"",

                "submit"=>"Enregistrer",
                "reset"=>"Annuler" ],


            "data"=>[
                "firstname"=>[
                    "type"=>"text",
                    "labelName"=>"Prénom",
                    "value"=>"$firstnameValue",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"firstname",
                    "minlength"=>2,
                    "maxlength"=>50,
                    "error"=>"Le prénom doit faire entre 2 et 50 caractères"
                ],
                "lastname"=>[
                    "type"=>"text",
                    "labelName"=>"Nom",
                    "value"=>"$lastnameValue",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"lastname","minlength"=>2,"maxlength"=>100,
                    "error"=>"Le nom doit faire entre 2 et 100 caractères"],

                "email"=>[
                    "type"=>"email",
                    "labelName"=>"Email",
                    "value"=>"$emailValue",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"email",
                    "maxlength"=>250,
                    "error"=>"L'email n'est pas valide ou il dépasse les 250 caractères"],

                "pwd"=>[
                    "type"=>"password",
                    "labelName"=>"Mot de passe",
                    "value"=>"",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"pwd",
                    "minlength"=>6,
                    "error"=>"Le mot de passe doit faire au minimum 6 caractères avec des minuscules, majuscules et chiffres"],

                "pwdConfirm"=>[
                    "type"=>"password",
                    "labelName"=>"Confirmation du mot de passe",
                    "value"=>"",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"pwdConfirm",
                    "confirm"=>"pwd",
                    "error"=>"Les mots de passe ne correspondent pas"
                ]
            ]
        ];
    }

}
