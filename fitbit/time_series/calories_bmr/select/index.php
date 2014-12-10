<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 13:51
 */


include '../../../../db_connection.php';


$db_connection = new DatabaseConnection();

$db_connection->connect();


include '../../../id/find_calories_bmr_id.php';


$fetch = "SELECT value, date FROM value WHERE user_id='$userId' AND measurement_id = '$caloriesBMRId'";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


print_r($result);
?>