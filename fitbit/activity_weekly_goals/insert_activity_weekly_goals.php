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

include 'fetch_activity_weekly_goals.php';

//SQL Statement to insert data into value table
$insert_activity_daily_goals = "INSERT INTO goal (goal_value, startdate, enddate, period, user_id, measurement_id)
         VALUES ('$activeMinutes', Null, Null  , '$periodId', '42', '$activeMinutesId'),
('$caloriesOut', Null, Null  , '$periodId', '42', '$activityCaloriesOutId'),
('$distance', Null, Null  , '$periodId', '42', '$activityDistanceId'),
('$steps', Null, Null  , '$periodId', '42', '$activityStepsId')";

$db_connection->executeStatement($insert_activity_daily_goals);

?>