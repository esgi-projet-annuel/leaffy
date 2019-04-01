<?php
/**
 * Created by PhpStorm.
 * User: alix
 * Date: 2019-03-31
 * Time: 15:21
 */

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

//    public static function isAdmin(){
//        return ($this->user->getProfile() == "ADMIN")?true:false;
//    }

    public function login(string $email, string $pwd){
        if(!is_null($email) || !is_null($pwd)){
            $user = new User();
            $user->findOneBy(['email'=>$email], true);
            //checkPassword
            $verified = password_verify( $pwd, $user->password);
            if ($verified){
                $token= self::generateToken($user);
                session_start();
                $_SESSION= ['email' => $user->email, 'token'=> $token];
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function logout($redirect = null){
        $user = new User();
        $user->findOneBy($_SESSION['email']);
        session_destroy();
        $this->clearToken($user);
        if($redirect) header("Location: ".$redirect);
    }

    public function generateToken( User $user){
        //Chaîne aléatoire
        $token = md5(substr(uniqid().time(), 4, 10)."kfxcUYT87");

        if($user){
            //insertion en bdd
            $user->setToken($token);
            $user->save();
        }
        return $token;
    }
//
    public function clearToken(User $user){
        $user->setToken(null);
        $user->save();
    }




}