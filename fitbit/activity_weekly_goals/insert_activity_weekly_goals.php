<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */


$response = $fitbit->getActivityWeeklyGoals();


$distance = $response->goals->distance;
$steps = $response->goals->steps;


// icluding all files which are necessary to get the measurement ids
include '../id/find_company_id.php';
include '../id/find_period_weekly_id.php';
include '../id/find_distance_id.php';
include '../id/find_steps_id.php';


// Array for the different measurement ids
$idArray[0] = $distanceId;
$idArray[1] = $stepsId;

// Array for the different measurement values
$werteArray[0] = $distance;
$werteArray[1] = $steps;

// run through each value
for ($id = 0; $id < sizeof($idArray); $id++) {

    $ID = $idArray[$id];
    $wert = $werteArray[$id];

//SQL Statement to check if this data set already exists
    $select_activity_daily_goals = "SELECT * FROM goal WHERE user_id='42' AND measurement_id='$ID' AND company_id='$company_id' AND period= '$periodWeeklyId'";
    $result = $db_connection->executeStatement($select_activity_daily_goals);
    $rowCount = $result->num_rows;

    //weekly goal is not inserted yet
    if ($rowCount == 0) {
        $insert_activity_daily_goals = "INSERT INTO goal (goal_value, startdate, enddate, period, user_id, measurement_id, company_id)
         VALUES ('$wert', Null, Null, '$periodWeeklyId', '42', '$ID', '$company_id')";
        $db_connection->executeStatement($insert_activity_daily_goals);

        //weekly goal was already inserted
    } else {
        $update_activity_daily_goals = "UPDATE goal set goal_value='$wert', startdate=NULL, enddate=NULL, period='$periodWeeklyId',
                                    user_id='42', measurement_id='$ID', company_id='$company_id'
                                     WHERE user_id='42' AND measurement_id='$ID' AND company_id='$company_id' AND period='$periodWeeklyId'";

        $db_connection->executeStatement($update_activity_daily_goals);
    }
}


?>
