<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 12.12.14
 * Time: 00:20
 */

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$passwordHashed = password_hash($password, PASSWORD_DEFAULT);

$dbConnection = new DatabaseConnection();

$dbConnection->connect();

$change_password = "UPDATE user SET password = '$passwordHashed' WHERE email = '$email '";

$dbConnection->executeStatement($change_password);

echo '{"success" : 1, "message" : "Password successfully changed"}';

?>