<?php
declare(strict_types = 1);

namespace LeaffyMvc\Services;

use LeaffyMvc\Models\User;

class AuthenticationService
{

    private static $instance;

    public static function instance(){
        if(self::$instance == null) {
            self::$instance = new AuthenticationService();
        }

        return self::$instance;
    }

    public static function isConnected():bool {
        if (isset($_SESSION['email'])){
            return true;
        }
        return false;
    }

    public function isAdmin():bool {
        return isset($_SESSION['email']) && $_SESSION['profile'] == "ADMIN";
    }

    public function isEditor():bool {
        return isset($_SESSION['email']) && $_SESSION['profile'] == "EDITOR";
    }

    public function login(User $user, string $email, string $pwd){
        if(!is_null($email) || !is_null($pwd)){
            if ($user->findOneObjectBy(['email'=>$email]) != null){
                //checkPassword
                $verified = password_verify( $pwd, $user->password);
                $isActive = ($user->active == 1)?true:false;
                if ($verified && $isActive){
                    $token= $this->generateToken($user);
                    $_SESSION = ['userId' => $user->id, 'email' => $user->email, 'token'=> $token, 'profile' => $user->profile];
                    return true;
                }else{
                    return false;
                }
            }else {
                return false;
            }
        }else{
            return false;
        }
    }

    public function logout(User $user, $redirect = null):void{
        $user->findOneObjectBy(['email'=>$_SESSION['email']]);
        $this->clearToken($user);
        unset($_SESSION['token']);
        session_destroy();
        if($redirect) header("Location: ".$redirect);
    }

    public static function generateToken(User $user):string{
        //Chaîne aléatoire
        $token = md5(substr(uniqid().time(), 4, 10)."kfxcUYT87");

        if($user){
            //insertion en bdd
            $user->setToken($token);
            $user->save();
        }
        return $token;
    }

    public function clearToken(User $user):void{
        $user->setToken(null);
        $user->save();
    }




}
