<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 10.12.14
 * Time: 21:45
 */

//TODO needs to be tested. Redirection to iPhone
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../db_connection.php';

if($_REQUEST['email'] && $_REQUEST['verifier']) {

    $email = $_REQUEST['email'];
    $verifier = $_REQUEST['verifier'];

    $dbConnection = new DatabaseConnection();

    $dbConnection->connect();

    $select_user = "SELECT email FROM user WHERE email = '$email' AND verifier = '$verifier'";

    $dbConnection->executeStatement($select_user);

    $result = $dbConnection->getResult();

    if (mysqli_num_rows($result) > 0) {

        $set_user_active = "UPDATE user SET active = 'Yes' WHERE email = '$email'";

        $dbConnection->executeStatement($set_user_active);

        echo "Thank you for your Registration!";
    }

    $dbConnection->close();
}

?>