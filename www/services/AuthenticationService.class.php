<?php

declare(strict_types = 1);

class AuthenticationService
{

    private static $instance;

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

    public function isAdmin(User $user){
        return ($user->getProfile() == "ADMIN")?true:false;
    }

    public function login(User $user, string $email, string $pwd){
        if(!is_null($email) || !is_null($pwd)){
            $user->findOneObjectBy(['email'=>$email]);
            //checkPassword
            $verified = password_verify( $pwd, $user->password);
            $isActive = ($user->active == 1)?true:false;
            if ($verified && $isActive){
                $token= $this->generateToken($user);
                $_SESSION= ['email' => $user->email, 'token'=> $token];
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function logout(User $user, $redirect = null){
        $user->findOneObjectBy(['email'=>$_SESSION['email']]);
        $this->clearToken($user);
        unset($_SESSION['token']);
        if($redirect) header("Location: ".$redirect);
    }

    public function generateToken(User $user){
        //Chaîne aléatoire
        $token = md5(substr(uniqid().time(), 4, 10)."kfxcUYT87");

        if($user){
            //insertion en bdd
            $user->setToken($token);
            $user->save();
        }
        return $token;
    }

    public function clearToken(User $user){
        $user->setToken(null);
        $user->save();
    }




}