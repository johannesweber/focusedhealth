<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */

//date for daily goal
$timestamp=time();
$date=date("Y-m-d", $timestamp);

$response = $fitbit->getWaterGoal();

$waterGoal = $response->goal->goal;


include '../../id/find_water_id.php';

//SQL Statement to insert data into value table
$insert_water_goal = "INSERT INTO goal (goal_value, startdate, enddate, user_id, measurement_id)
         VALUES ('$waterGoal', '$date', '$date', '42', '$waterId')";

$db_connection->executeStatement($insert_water_goal);

?>