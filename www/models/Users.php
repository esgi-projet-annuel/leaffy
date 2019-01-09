<?php

class Users extends BaseSQL {

    public $id = null;
    public $profile;
    public $firstname;
    public $lastname;
    public $login;
    public $email;
    public $password;

    public function __construct(){
        parent::__construct();
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setProfile( string $profile)
    {
        $this->profile = $profile;
    }

    public function setFirstname(string $firstname)
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    public function setLastname( string $lastname)
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    public function setLogin(string $login)
    {
        $this->login = strtolower(trim($login));
    }

    public function setEmail(string $email)
    {
        $this->email = strtolower(trim($email));
    }

    public function setPassword(string $password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }


}