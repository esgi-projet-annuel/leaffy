<?php

class User extends BaseSQL {

    private $profile;
    private $firstname;
    private $lastname;
    private $login;
    private $email;
    private $password;
    private $profession = null ;

    public function __construct(){
        parent::__construct();
    }

    public function setProfile(string $profile) {
        $this->profile = $profile;
    }

    public function setFirstname(string $firstname) {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    public function setLastname( string $lastname) {
        $this->lastname = strtoupper(trim($lastname));
    }

    public function setLogin(string $login) {
        $this->login = strtolower(trim($login));
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


}