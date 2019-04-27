<?php

declare(strict_types = 1);

class User extends BaseSQL {

    public $profile;
    public $active;
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

    public function getSettingForm(){
        return [
            "config"=>[
              "method"=>"POST",
              "action"=> /*ADD ACTION SLUG ?*/"",
              "class"=>"",
              "id"=>"",
              "submit"=>"Enregistrer"],


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

              "lastname"=>["type"=>"text","placeholder"=>"Votre nom", "required"=>true, "class"=>"form-control-back", "id"=>"lastname","minlength"=>2,"maxlength"=>100,
                "error"=>"Le nom doit faire entre 2 et 100 caractères"],

              "number"=>["type"=>"text","placeholder"=>"Votre numéro", "required"=>false, "class"=>"form-control-back", "id"=>"number","minlength"=>2,"maxlength"=>100,
                "error"=>"Le numero n'est pas valide"],

              "email"=>["type"=>"email","placeholder"=>"Votre email", "required"=>true, "class"=>"form-control-back", "id"=>"email",
                  "error"=>"L'email n'est pas valide"],

              "adress"=>["type"=>"text","placeholder"=>"Votre Adresse", "required"=>false, "class"=>"form-control-back", "id"=>"adress","minlength"=>2,"maxlength"=>100,
                "error"=>"L'adresse n'est pas valide"],

              "job"=>["type"=>"text","placeholder"=>"Votre Profession", "required"=>false, "class"=>"form-control-back", "id"=>"job","minlength"=>2,"maxlength"=>100,
                "error"=>"L'adresse n'est pas valide"],

              "apropos"=>["type"=>"textarea","placeholder"=>"Texte à propos", "required"=>false, "class"=>"form-control-back", "id"=>"job","minlength"=>0,"maxlength"=>500,
                "error"=>"L'image n'est pas valide"],

              "bannerImg"=>["type"=>"file","placeholder"=>"Image principale", "required"=>false, "class"=>"form-control-back", "bannerImg"=>"job","minlength"=>0,"maxlength"=>500,
                "error"=>"Le nom doit faire moins de 500 caractères"],
              "aProposImg"=>["type"=>"file","placeholder"=>"Image à propos", "required"=>false, "class"=>"form-control-back", "bannerImg"=>"job","minlength"=>0,"maxlength"=>500,
                "error"=>"L'image n'est pas valide"],
            ]

        ];
    }
}
