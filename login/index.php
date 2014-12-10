<?php

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../db_connection.php';

//TODO change login and signup from $_GET to $_POST. Logind ans Signups needs to be tested
if($_GET) {
    $email   = trim($_GET['email']);
    $password   = trim($_GET['password']);

    if($email && $password) {

        $dbConnection = new DatabaseConnection();

        $dbConnection->connect();

        $stmt = "SELECT email, password FROM user WHERE email LIKE '$email' LIMIT 1";

        $dbConnection->executeStatement($stmt);
        $result = $dbConnection->getResultAsArray();

        if(password_verify($password, $result['password'])){

            require_once 'is_user_active.php';

            if ($active == 'Yes'){

                $select_user_id = "SELECT id FROM user WHERE email LIKE '$email' LIMIT 1";

                $dbConnection->executeStatement($select_user_id);
                $userResult = $dbConnection->getResultAsArray();
                $userId = $userResult['id'];

                echo '{"success" : 1, "userId" : ' . $userId . '}';

            } else {
                echo '{"success" : 0,"error_message" : "Please activate your account."}';
            }

        } else {
            echo '{"success" : 0,"error_message" : "Invalid E - Mail/Password."}';
        }

    } else {
        echo '{"success" : 0,"error_message" : "Invalid E - Mail/Password."}';
    }
}else {
    echo '{"success" : 0,"error_message" : "Invalid Data."}';
}

$dbConnection->close();

?>
