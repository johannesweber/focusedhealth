<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

//date for daily goal
$timestamp = time();
$date = date("Y-m-d", $timestamp);

$response = $fitbit->getWaterGoal();
$waterGoal = $response->goal->goal;

// to get the Id's for the measurement name
$measurementName='water';
$waterId = $db_connection->getMeasurementId($measurementName);
$measurementName='daily';
$periodDailyId = $db_connection->getMeasurementId($measurementName);


$error = true;

include '../id/find_company_id.php';


$select_water_goal = "SELECT * FROM goal WHERE user_id='$userId' AND measurement_id='$waterId' AND company_id='$company_id'";
$result = $db_connection->executeStatement($select_water_goal);
$rowCount = $result->num_rows;

if ($rowCount == 0) {
    $insert = "INSERT INTO goal (goal_value, startdate, enddate, period, user_id, measurement_id, company_id)
VALUES ('$waterGoal', Null, Null, '$periodDailyId', '$userId', '$waterId', '$company_id')";

    $db_connection->executeStatement($insert);

    $result = $db_connection->executeStatement($select);
    if (!$result) {
        $error = false;
    }

} else {

    $update_water_goal = "UPDATE goal set goal_value='$waterGoal', startdate=NULL, enddate=NULL, period='$periodDailyId',
user_id='$userId', measurement_id='$waterId', company_id='$company_id'
WHERE user_id='$userId' AND measurement_id='$waterId' and company_id='$company_id'";
    $result = $db_connection->executeStatement($update_water_goal);

    if (!$result) {
        $error = false;
    }

}

if (!$error) {
    echo '{"success" : "-1", "message" : "steps statement was not successfull"}';
} else {
    echo '{"success" : "1", "message" : "steps statement was successfull"}';
}


?>