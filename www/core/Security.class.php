<?php

class Security {

    private $user;

    public function __construct(string $email){

        $email = (isset($_SESSION["email"]))?$_SESSION["email"]:$email;
        //création de l'objet user
        $this->user= new User();
        if( !is_null($email)){
            //Vérification de l'email en bdd
            $this->user->findOneBy(['email'=>$email], true);
        }
    }


    public function isConnected(){
        if (isset($_SESSION)){

        }
        //Est ce qu'il y a une session
        //Vérification de l'email et du token
        //génération d'un nouveau token
        return bool;
    }

    public function isAdmin(){
        return ($this->user->getProfile() == "ADMIN")?true:false;
    }

    public function login(string $pwd){
        //checkPassword
        $verified = password_verify( $pwd, $this->user->getPassword() );
        if ($verified){
            $token= self::generateToken();
            $_SESSION= ['email' => $this->user->getEmail(), 'token'=> $token];
            return true;
        }else{
            return false;
        }
    }

    public function logout($redirect = null){
        session_destroy();
        $this->clearToken();
        if($redirect) header("Location: ".$redirect);
    }


    public function generateToken(){
        $token = md5(substr(uniqid().time(), 4, 10)."kfxcUYT87");

        //Chaîne aléatoire
        if($this->user){
            //insertion en bdd
            $this->user->setToken($token);
            $this->user->save();
        }
        return $token;
    }

    public function clearToken(){
        $this->user->setToken(null);
        $this->user->save();
    }


}