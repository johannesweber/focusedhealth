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

            $stmt = "INSERT INTO user (email, password) VALUES ('$email', '$passwordHashed')";

            $dbConnection->executeStatement($stmt);

            $result = $dbConnection->getResult();

            if ($result == true) {
                echo '{"success" : 1}';
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
