<?php
declare(strict_types = 1);

namespace LeaffyMvc\Services;

require './vendor/autoload.php';

use LeaffyMvc\Core\View;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use LeaffyMvc\Models\User;

class MailConfirmationService {

    private static $instance;
    private static $adminMail= "contact@leaffy.fr";

    public static function instance(){
        if(self::$instance == null) {
            self::$instance = new MailConfirmationService();
        }

        return self::$instance;
    }

    private function initPHPMailer(): PHPMailer{
        $mail= new PHPMailer();
//        $mail->SMTPDebug = 1;
        //Enable SMTP debugging.
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        //Set SMTP host name
        $mail->Host = "smtp.ionos.fr";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;
        //Provide username and password
        $mail->Username = "m91014035-138437401";
        $mail->Password = "8w3VtRz[X9)";
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";
        //Set TCP port to connect to
        $mail->Port = 587;

        $mail->From = "contact@leaffy.fr";
        $mail->FromName = "leaffy admin";

        $mail->smtpConnect(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            )
        );
        return $mail;
    }

    public static function sendMail(string $subject, string $bodyType, User $user= null){
        $mail = self::$instance->initPHPMailer();
        if ($user != null){
            $mail->addAddress($user->email);
        }else{
            $mail->addAddress(self::$adminMail);
        }
        $mail->isHTML(true);
        $mail->Subject = utf8_decode($subject);
        //TODO ecrire l'url dynamiquement
        switch ($bodyType){
            case 'register':
                $mail->Body = self::$instance->getConfirmationMail($user);
                break;
            case 'comment':
                $mail->Body = self::$instance->getCommentsAlertMail();
                break;
            case 'testimonial':
                $mail->Body = self::$instance->getTestimonialsAlertMail();
                break;
            case 'forgottenPassword':
                $mail->Body = self::$instance->getForgottenPasswordMail($user);
                break;
        }


        if(!$mail->send())
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
            echo "Message has been sent successfully";
        }
    }

    private function getConfirmationMail(User $user): string {
        return "<i>Bienvenue sur Leaffy, <br>
    Pour activer votre compte, veuillez cliquer sur le lien ci dessous<br>
    ou copier/coller dans votre navigateur internet.<br>

    http://localhost:88/validation?email=".urlencode($user->email)."&token=".urlencode($user->token)."<br>


    ---------------<br>
    Ceci est un mail automatique, Merci de ne pas y répondre.</i>";
    }

    private function getCommentsAlertMail(){
        $htmlMail = "<p> De nouveaux commentaires ont été déposés! </p>";
        $htmlMail .= "<p> Rendez vous vite sur votre interface administrateur. </p>";
        return utf8_decode($htmlMail);
    }

    private function getTestimonialsAlertMail(){
        $htmlMail = "<p> De nouveaux avis ont été déposés! </p>";
        $htmlMail .= "<p> Rendez vous vite sur votre interface administrateur. </p>";
        return utf8_decode($htmlMail);
    }

    private function getForgottenPasswordMail(User $user){
        $htmlMail = "<p> Rendez vous sur le lien suivant afin de réinitialiser votre mot de passe </p>";
        $htmlMail .= "<p> http://localhost:88/resetPassword?email=".urlencode($user->email)."&token=".urlencode($user->token)." </p>";
        return utf8_decode($htmlMail);
    }
}