<?php

class User extends BaseSQL {

    public $profile;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $profession = null;
    public $token = null;

    public function __construct(){
        parent::__construct();
    }

    // SETTER
    public function setProfile(string $profile) {
        $this->profile = $profile;
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

    public function setToken(string $token) {
        $this->token = trim($token);
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

    public function getProfession():string{
        return $this->profession;
    }

    public function getToken():string {
        return$this->token;
    }


    public function getLoginForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Routing::getSlug("Authentication","authenticateUser"),
                "class"=>"",
                "id"=>"",
                "submit"=>"Se connecter",
                "reset"=>"Annuler" ],


            "data"=>[

                "email"=>["type"=>"email","placeholder"=>"Votre email", "required"=>true, "class"=>"form-control-login", "id"=>"email",
                    "error"=>"L'email n'est pas valide"],

                "pwd"=>["type"=>"password","placeholder"=>"Votre mot de passe", "required"=>true, "class"=>"form-control-login", "id"=>"pwd",
                    "error"=>"Veuillez préciser un mot de passe"]


            ]

        ];
    }

    public function getRegisterForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Routing::getSlug("User","saveUser"),
                "class"=>"",
                "id"=>"",
                "submit"=>"S'inscrire",
                "reset"=>"Annuler" ],


            "data"=>[

                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre Prénom",
                    "required"=>true,
                    "class"=>"form-control-login",
                    "id"=>"firstname",
                    "minlength"=>2,
                    "maxlength"=>50,
                    "error"=>"Le prénom doit faire entre 2 et 50 caractères"
                ],

                "lastname"=>["type"=>"text","placeholder"=>"Votre nom", "required"=>true, "class"=>"form-control-login", "id"=>"lastname","minlength"=>2,"maxlength"=>100,
                    "error"=>"Le nom doit faire entre 2 et 100 caractères"],

                "email"=>["type"=>"email","placeholder"=>"Votre email", "required"=>true, "class"=>"form-control-login", "id"=>"email","maxlength"=>250,
                    "error"=>"L'email n'est pas valide ou il dépasse les 250 caractères"],

                "pwd"=>["type"=>"password","placeholder"=>"Votre mot de passe", "required"=>true, "class"=>"form-control-login", "id"=>"pwd","minlength"=>6,
                    "error"=>"Le mot de passe doit faire au minimum 6 caractères avec des minuscules, majuscules et chiffres"],

                "pwdConfirm"=>["type"=>"password","placeholder"=>"Confirmation", "required"=>true, "class"=>"form-control-login", "id"=>"pwdConfirm", "confirm"=>"pwd", "error"=>"Les mots de passe ne correspondent pas"]

            ]

        ];
    }
}