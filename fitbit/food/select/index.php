<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 11:08
 */


include '../../../db_connection.php';

$timestamp = time();
$date = date("Y-m-d", $timestamp);

$db_connection = new DatabaseConnection();

$db_connection->connect();


$fetch_food = "SELECT date, amount, name, unit, calories, carbs, fat, fiber, protein, sodium FROM food WHERE user_id='42'AND date='$date'";

$db_connection->executeStatement($fetch_food);
$result = $db_connection->getResultAsJSON();

echo $result;
?>