<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 11.12.14
 * Time: 13:23
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once 'library/PHPMailer/PHPMailerAutoload.php';

class Mail{

    function smtpmailer($to, $from, $from_name, $subject, $message) {

        global $error;
        $mail = new PHPMailer();  // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = 'weber.johanes@gmail.com';
        $mail->Password = 'johannes86';
        $mail->SetFrom($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AddAddress($to);
        if(!$mail->Send()) {
            $error = 'Mail error: '.$mail->ErrorInfo;
            return false;
        } else {
            $error = 'Message sent!';
            return true;
        }
    }

}

?>