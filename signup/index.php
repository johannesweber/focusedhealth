<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

header('Content-type: application/json');

require_once '../db_connection.php';

if($_POST) {
    $email   = $_POST['email'];
    $password   = $_POST['password'];
    $c_password = $_POST['c_password'];

    if($_POST['email']) {
        if ( $password == $c_password ) {

            $dbConnection = new DatabaseConnection();

            $dbConnection->connect();

            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

            $select_same_user = "SELECT email FROM user WHERE email LIKE '$email'";

            $result = $dbConnection->executeStatement($select_same_user);

            $count_same_user = mysqli_num_rows($result);

            if ($count_same_user == 0){
                $stmt = "INSERT INTO user (email, password) VALUES ('$email', '$passwordHashed')";

                $dbConnection->executeStatement($stmt);

                $result = $dbConnection->getResultAsArray();

                if($result == true){
                    error_log("User '$email' created.");
                    echo '{"success":1}';
                } else {
                    echo '{"success":0,"error_message":"E - Mail Exist."}';
                }
            } else{
                echo '{"success":0,"error_message":"Username already exists."}';
            }
        } else {
            echo '{"success":0,"error_message":"Passwords does not match."}';
        }
    } else {
        echo '{"success":0,"error_message":"Invalid E - Mail."}';
    }
}else {
    echo '{"success":0,"error_message":"Invalid Data."}';
}
$dbConnection->close();
?>
