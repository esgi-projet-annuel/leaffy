<?php
declare(strict_types = 1);

namespace LeaffyMvc\Services;

require './vendor/autoload.php';

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

    public static function sendMail(string $subject, string $bodyType, User $user= null){
        $mail = self::$instance->intiPHPMailer();
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


        if(!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        
    }

    private function getConfirmationMail(User $user): string {
        return "<body align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse;'>
                  <table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='#f9f8eb'>
                    <tr>
                      <td align='center' bgcolor='#5c8d89' style='padding: 40px 0 30px 0; font-size:30px; color:white;'>
                          Bienvenue sur Leaffy !
                      </td>
                    </tr>
                    <tr>
                      <td align='center' style='padding: 40px 30px 40px 30px; font-size:20px;'>Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou le copier/coller dans votre navigateur internet.</td>
                    </tr>
                    <tr>
                      <td align='center' style='padding: 40px 30px 40px 30px; font-size:20px;'>http://".$_SERVER['HTTP_HOST']."/validation?email=".urlencode($user->email)."&token=".urlencode($user->token)."</td>
                    </tr>
                    <tr>
                      <td align='center'>Ceci est un mail automatique, Merci de ne pas y répondre.</td>
                    </tr>
                  </table>

                </body>";
    }

    private function getCommentsAlertMail(){
        $htmlMail = "<body align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse;'>";
        $htmlMail .= "<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='#f9f8eb'>";
        $htmlMail .= "<tr><td align='center' bgcolor='#5c8d89' style='padding: 40px 0 30px 0; font-size:30px; color:white;'>De nouveaux commentaires ont été déposés !</td></tr>";
        $htmlMail .= "<tr><td align='center' style='padding: 40px 30px 40px 30px; font-size:20px;'>Rendez vous vite sur votre interface administrateur. </td></tr>";
        $htmlMail .= "<tr><td align='center'>Ceci est un mail automatique, Merci de ne pas y répondre.</td></tr>";
        $htmlMail .= "</table>";
        $htmlMail .= "</body>";
        return utf8_decode($htmlMail);
    }

    private function getTestimonialsAlertMail(){
      $htmlMail = "<body align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse;'>";
      $htmlMail .= "<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='#f9f8eb'>";
      $htmlMail .= "<tr><td align='center' bgcolor='#5c8d89' style='padding: 40px 0 30px 0; font-size:30px; color:white;'>De nouveaux avis ont été déposés !</td></tr>";
      $htmlMail .= "<tr><td align='center' style='padding: 40px 30px 40px 30px; font-size:20px;'>Rendez vous vite sur votre interface administrateur. </td></tr>";
      $htmlMail .= "<tr><td align='center'>Ceci est un mail automatique, Merci de ne pas y répondre.</td></tr>";
      $htmlMail .= "</table>";
      $htmlMail .= "</body>";
      return utf8_decode($htmlMail);
    }

    private function getForgottenPasswordMail(User $user){
        $htmlMail = "<body align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse;'>";
        $htmlMail .= "<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='#f9f8eb'>";
        $htmlMail .= "<tr><td align='center' bgcolor='#5c8d89' style='padding: 40px 0 30px 0; font-size:30px; color:white;'>Rendez vous sur le lien suivant afin de réinitialiser votre mot de passe </td></tr>";
        $htmlMail .= "<tr><td align='center' style='padding: 40px 30px 40px 30px; font-size:20px;'>http://".$_SERVER['HTTP_HOST']."/resetPassword?email=".urlencode($user->email)."&token=".urlencode($user->token)."</td></tr>";
        $htmlMail .= "<tr><td align='center'>Ceci est un mail automatique, Merci de ne pas y répondre.</td></tr>";
        $htmlMail .= "</table>";
        $htmlMail .= "</body>";
        return utf8_decode($htmlMail);
    }
}
