<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 18:00
 */


include '../../../../db_connection.php';


$db_connection = new DatabaseConnection();

$db_connection->connect();


<<<<<<< HEAD
include 'find_bmi_id.php';


$fetch_food = "SELECT value, date FROM value WHERE user_id='42' AND measurement_id = '$bmiId'";

$db_connection->executeStatement($fetch_food);
$result = $db_connection->getResultAsJSON();


print_r($result);
=======
include '../../../id/find_bmi_id.php';


$fetch = "SELECT value, date FROM value WHERE user_id='42' AND measurement_id = '$bmiId'";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


print_r($result);
?>
>>>>>>> FETCH_HEAD
