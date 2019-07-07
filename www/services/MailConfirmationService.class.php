<?php
declare(strict_types = 1);

namespace LeaffyMvc\Services;

require './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailConfirmationService {

    private static $instance;

    public static function instance(){
        if(self::$instance == null) {
            self::$instance = new MailConfirmationService();
        }

        return self::$instance;
    }

    private function intiPHPMailer(): PHPMailer{
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

    public static function sendConfirmationMail(string $email, string $token){
        $mail = self::$instance->intiPHPMailer();
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Bienvenue!";
        //TODO ecrire l'url dynamiquement
        $mail->Body = "<i>Bienvenue sur Leaffy, <br>
                Pour activer votre compte, veuillez cliquer sur le lien ci dessous<br>
                ou copier/coller dans votre navigateur internet.<br>
                 
                http://localhost:88/validation?email=".urlencode($email)."&token=".urlencode($token)."<br>
                 
                 
                ---------------<br>
                Ceci est un mail automatique, Merci de ne pas y répondre.</i>";
        $mail->AltBody = "Bienvenue sur Leaffy,
 
                Pour activer votre compte, veuillez cliquer sur le lien ci dessous
                ou copier/coller dans votre navigateur internet.
                 
                
                 
                 
                ---------------
                Ceci est un mail automatique, Merci de ne pas y répondre.";

        if(!$mail->send())
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
            echo "Message has been sent successfully";
        }
    }
}