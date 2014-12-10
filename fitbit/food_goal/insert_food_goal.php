<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */

$timestamp=time();
$date=date("Y-m-d", $timestamp);

$response = $fitbit->getFoodGoal();

$foodGoal = $response->goals->calories;

include '../id/find_calories_id.php';
include '../id/find_company_id.php';
include '../id/find_period_daily_id.php';

//SQL Statement to check if this data set already exists
$select_food_goal = "SELECT * FROM goal WHERE user_id='42' AND measurement_id='$caloriesId' AND company_id='$company_id'";
$result = $db_connection->executeStatement($select_food_goal);
$rowCount = $result->num_rows;

if ($rowCount == 0) {

    $insert_food_goal = "INSERT INTO goal (goal_value, startdate, enddate, period, user_id, measurement_id, company_id)
         VALUES ('$foodGoal', Null, Null, '$periodDailyId', '42', '$caloriesId', '$company_id')";
    $db_connection->executeStatement($insert_food_goal);

    //food goal was already inserted
} else {

$update_food_goal = "UPDATE goal set goal_value='$foodGoal', startdate=NULL, enddate=NULL, period='$periodDailyId',
                                    user_id='42', measurement_id='$caloriesId', company_id='$company_id'
                                     WHERE user_id='42' AND measurement_id='$caloriesId' and company_id='$company_id'";
    $db_connection->executeStatement($update_food_goal);
}

?>
