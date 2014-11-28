<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */

$timestamp=time();
$date=date("Y-m-d", $timestamp);

$response = $fitbit->getWeightGoal();
print_r($response);

$weightGoal = $response->goal->weight;
$startDate = $response->goal->startDate;
$startWeight = $response->goal->startWeight;


include 'fetch_weight_goal.php';

//SQL Statement to insert data into value table
$insert_weight_goal = "INSERT INTO goal (goal_value, start_value, startdate, enddate, user_id, measurement_id)
         VALUES ('$weightGoal', '$startWeight', '$startDate', NULL, '42', '$weightId')";

$db_connection->executeStatement($insert_weight_goal);

?>