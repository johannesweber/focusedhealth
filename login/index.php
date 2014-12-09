<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

header('Content-type: application/json');

require_once '../db_connection.php';

if($_POST) {
    $email   = trim($_POST['email']);
    $password   = trim($_POST['password']);

    if($email && $password) {

        $dbConnection = new DatabaseConnection();

        $dbConnection->connect();

        $stmt = "SELECT email, password FROM user WHERE email LIKE '$email' LIMIT 1";

        $dbConnection->executeStatement($stmt);
        $result = $dbConnection->getResultAsArray();

        if(password_verify($password, $result['password'])){
            error_log("User $email: password match.");
            echo '{"success":1}';
        } else {
            error_log("User $email: password doesn't match.");
            echo '{"success":0,"error_message":"Invalid E - Mail/Password"}';
        }

    } else {
        echo '{"success":0,"error_message":"Invalid E - Mail/Password."}';
    }
}else {
    echo '{"success":0,"error_message":"Invalid Data."}';
}

$dbConnection->close();

?>
