<?php

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../db_connection.php';

if($_GET) {
    $email   = $_GET['email'];
    $password   = $_GET['password'];
    $c_password = $_GET['c_password'];


    if($_GET['email']) {
        if ( $password == $c_password ) {

            $dbConnection = new DatabaseConnection();

            $dbConnection->connect();

            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

            $stmt = "INSERT INTO user (email, password, active) VALUES ('$email', '$passwordHashed', 'No')";

            $dbConnection->executeStatement($stmt);

            $result = $dbConnection->getResult();

            if ($result == true) {

                //TODO sending an email needs to be tested if mail server is available
                $senderFromMail = "weber.johanes@gmail.com";

                $verifier = rand(1, 999999);

                mail($email, "Activate Your Account", "Hello, \n\n to activate your Account please click the following link :\n\n http://141.19.142.45/~johannes/focusedhealth/signup/activate_account.php?email=$email&verifier=$verifier", "FROM: $senderFromMail");

                echo '{"success" : 1 , "active" : "No" , "error_message" : "E-Mail has been successfully sent to your Address. Please activate your Account with clicking the received link."}';
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
