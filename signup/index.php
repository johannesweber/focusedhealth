<?php

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../db_connection.php';

require_once '../mail.php';

if($_GET) {
    $email   = $_GET['email'];
    $password   = $_GET['password'];
    $c_password = $_GET['c_password'];


    if($_GET['email']) {
        if ( $password == $c_password ) {

            $dbConnection = new DatabaseConnection();

            $dbConnection->connect();

            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

            $timestamp = time();
            $memberSince = date("Y-m-d", $timestamp);

            $verifier = rand(1, 999999999);

            $insert_user = "INSERT INTO user (email, password, active, verifier, memberSince) VALUES ('$email', '$passwordHashed', 'No', '$verifier', '$memberSince')";

            
            $dbConnection->executeStatement($insert_user);

            $result = $dbConnection->getResult();

            if ($result) {

                $to = $email;
                $from = "weber.johanes@gmail.com";
                $from_name = "Team 5ive";
                $subject = "Account Activation";

                $message  = "Please click on the following link to activate your Account \n\n";
                $message .= "http://141.19.142.45/~johannes/focusedhealth/signup/activate_account.php?email=$email&verifier=$verifier\n\n";
                $message .= "Thank You.";

                $mail = new Mail();

                $mail->smtpmailer($to, $from, $from_name, $subject, $message);

                echo '{"success" : 1 , "active" : "No" , "error_message" : "You are succesfully signed up. An Email has been sent to your Account. Please click the Link to activate your Account"}';
            }
        } else {
            echo '{"success": 0 ,"error_message" : "Passwords do not match."}';
        }
    } else {
        echo '{"success" : 0, "error_message" : "Please enter your E-Mail."}';
    }
}else {
    echo '{"success" : 0, "error_message" : "Please enter your E-Mail and Password"}';
}
?>
