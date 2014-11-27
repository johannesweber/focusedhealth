<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */

$timestamp=time();
$date=date("Y-m-d", $timestamp);

$response = $fitbit->getActivityDailyGoals();
print_r($response);

$activeMinutes = $response->goals->activeMinutes;
$caloriesOut = $response->goals->caloriesOut;
$distance = $response->goals->distance;
$steps = $response->goals->steps;

include '../../id/find_company_id.php';
include '../../id/find_distance_id.php';
include '../../id/find_calories_out_id.php';
include '../../id/find_active_minutes_id.php';
include '../../id/find_period_daily_id.php';
include '../../id/find_steps_id.php';


//SQL Statement to insert data into value table
$insert_activity_daily_goals = "INSERT INTO goal (goal_value, startdate, enddate, period, user_id, measurement_id)
         VALUES ('$activeMinutes', Null, Null  , '$periodId', '42', '$activeMinutesId'),
('$caloriesOut', Null, Null  , '$periodId', '42', '$activityCaloriesOutId'),
('$distance', Null, Null  , '$periodId', '42', '$activityDistanceId'),
('$steps', Null, Null  , '$periodId', '42', '$activityStepsId')";


//SQL Statement to insert data into value table
$select_activity_daily_goals = "SELECT * FROM goal WHERE user_id='42' AND measurement_id='$activeMinutes' AND company_id='$company_id'";
$result = $db_connection->executeStatement($select_activity_daily_goals);
$rowCount = $result->num_rows;

if ($rowCount == 0) {
    $insert_activity_daily_goals = "INSERT INTO goal (goal_value, startdate, enddate, period, user_id, measurement_id, company_id)
         VALUES ('$foodGoal', Null, Null, '$periodDailyId', '42', '$caloriesId', '$company_id')";
    $db_connection->executeStatement($insert_activity_daily_goals);
} else {
    $update_food_goal = "UPDATE goal set goal_value='$foodGoal', startdate=NULL, enddate=NULL, period='$periodDailyId',
                                    user_id='42', measurement_id='$caloriesId', company_id='$company_id'
                                     WHERE user_id='42' AND measurement_id='$caloriesId' and company_id='$company_id'";
    $db_connection->executeStatement($update_activity_daily_goals);
}
?>