<?php

declare(strict_types = 1);

class AuthenticationService
{

    private static $instance;
    /**
     * @var User
     */
    protected $user;

    public static function instance(){
        if(self::$instance == null) {
            self::$instance = new AuthenticationService();
        }

        return self::$instance;
    }

    public static function isConnected(){
        if (isset($_SESSION['email'])){
            return true;
            //Est ce qu'il y a une session
        //Vérification de l'email et du token
        //génération d'un nouveau token
        //return bool;
        }
        return false;
    }

    public function isAdmin(){
        return ($this->user->getProfile() == "ADMIN")?true:false;
    }

    public function login(string $email, string $pwd){
        if(!is_null($email) || !is_null($pwd)){
            $this->user = new User();
            $this->user->findOneObjectBy(['email'=>$email]);
            //checkPassword
            $verified = password_verify( $pwd, $this->user->password);
            if ($verified){
                $token= $this->generateToken();
                $_SESSION= ['email' => $this->user->email, 'token'=> $token];
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function logout($redirect = null){
        $this->user= new User();
        $this->user->findOneObjectBy(['email'=>$_SESSION['email']]);
        $this->clearToken();
        unset($_SESSION['token']);
        if($redirect) header("Location: ".$redirect);
    }

    public function generateToken(){
        //Chaîne aléatoire
        $token = md5(substr(uniqid().time(), 4, 10)."kfxcUYT87");

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