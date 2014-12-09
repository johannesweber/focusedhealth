<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */


$response = $fitbit->getActivityDailyGoals();


$activeMinutes = $response->goals->activeMinutes;
$caloriesOut = $response->goals->caloriesOut;
$distance = $response->goals->distance;
$steps = $response->goals->steps;

// icluding all files which are necessary to get the measurement ids
include '../id/find_company_id.php';

include '../id/find_distance_id.php';
include '../id/find_active_minutes_id.php';
include '../id/find_calories_out_id.php';
include '../id/find_steps_id.php';

include '../id/find_period_daily_id.php';

// Array for the different measurement ids
$idArray[0] = $distanceId;
$idArray[1] = $activeMinutesId;
$idArray[2] = $caloriesOutId;
$idArray[3] = $stepsId;

// Array for the different measurement values
$werteArray[0] = $distance;
$werteArray[1] = $activeMinutes;
$werteArray[2] = $caloriesOut;
$werteArray[3] = $steps;

// run through ech
for ($id = 0; $id < sizeof($idArray); $id++) {

    $ID = $idArray[$id];
    $wert = $werteArray[$id];


//SQL Statement to insert data into goal table
    $select_activity_daily_goals = "SELECT * FROM goal WHERE user_id='42' AND measurement_id='$ID' AND company_id='$company_id' AND period= '$periodDailyId'";
    $result = $db_connection->executeStatement($select_activity_daily_goals);
    $rowCount = $result->num_rows;



    if ($rowCount == 0) {
        $insert_activity_daily_goals = "INSERT INTO goal (goal_value, startdate, enddate, period, user_id, measurement_id, company_id)
         VALUES ('$wert', Null, Null, '$periodDailyId', '42', '$ID', '$company_id')";
        $db_connection->executeStatement($insert_activity_daily_goals);
    } else {
        $update_activity_daily_goals = "UPDATE goal set goal_value='$wert', startdate=NULL, enddate=NULL, period='$periodDailyId',
                                    user_id='42', measurement_id='$ID', company_id='$company_id'
                                     WHERE user_id='42' AND measurement_id='$ID' AND company_id='$company_id' AND period='$periodDailyId'";

        $db_connection->executeStatement($update_activity_daily_goals);
    }
}

?>