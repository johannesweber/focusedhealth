<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 11.12.14
 * Time: 21:51
 */

//TODO How to delete the stored verifier after a spefific timeframe and how to detect wether i am on smartphone or web browser
header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

if($_GET) {
    if ($_GET['email'] && $_GET['verifier']) {

        $dbConnection = new DatabaseConnection();

        $dbConnection->connect();

        $select_user = "SELECT email, verifier
                        FROM user
                        WHERE email = '$email ' AND verifier = '$verifier'";

        $dbConnection->executeStatement($select_user);

        $result = $dbConnection->getResultAsArray();

        if ($email == $result['email'] && $verifier == $result['verifier']) {

            echo '{"success" : 1}';
            header('Location: oauth-callback://oauth-callback/password/forgot');
            exit();

        } else {

            echo '{"success" : 0, "message" : "You are looking for the wrong User!"}';
        }
    } else {

        echo '{"success" : 0, "message" : "Invalid Data!"}';
    }

}else {
    echo '{"success" : 0, "message" : "No Data available!"}';
}
?>
