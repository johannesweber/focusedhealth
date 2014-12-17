<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */

$timestamp = time();
$date = date("Y-m-d", $timestamp);

$response = $fitbit->getFoodGoal();

$caloriesId = getMeasurementId("calories", $db_connection);
$periodDailyId = getMeasurementId("daily", $db_connection);

$foodGoal = $response->goals->calories;


//SQL Statement to check if this data set already exists
$select_food_goal = "SELECT * FROM goal WHERE user_id='$userId' AND measurement_id='$caloriesId' AND company_id='$company_id'";
$result = $db_connection->executeStatement($select_food_goal);
$rowCount = $result->num_rows;

if ($rowCount == 0) {

    $insert_food_goal = "INSERT INTO goal (goal_value, startdate, enddate, period, user_id, measurement_id, company_id)
         VALUES ('$foodGoal', Null, Null, '$periodDailyId', '$userId', '$caloriesId', '$company_id')";
    $db_connection->executeStatement($insert_food_goal);

    //food goal was already inserted
} else {

    $update_food_goal = "UPDATE goal set goal_value='$foodGoal', startdate=NULL, enddate=NULL, period='$periodDailyId',
                                    user_id='$userId', measurement_id='$caloriesId', company_id='$company_id'
                                     WHERE user_id='$userId' AND measurement_id='$caloriesId' and company_id='$company_id'";
    $db_connection->executeStatement($update_food_goal);
}

?>
