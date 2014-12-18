<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */


$response = $fitbit->getWeightGoal();

$weightGoal = $response->goal->weight;
$startDate = $response->goal->startDate;
$startWeight = $response->goal->startWeight;

// to get the Id's for the measurement name
$measurementName='weight';
$weightId = $db_connection->getMeasurementId($measurementName);
$measurementName='daily';
$periodDailyId = $db_connection->getMeasurementId($measurementName);

$error = true;


$select_weight_goal = "SELECT * FROM goal WHERE user_id='$userId' AND measurement_id='$weightId' AND company_id='$company_id'";
$result = $db_connection->executeStatement($select_weight_goal);
$rowCount = $result->num_rows;

if ($rowCount == 0) {
    $insert = "INSERT INTO goal (goal_value, start_value, startdate, enddate, period, user_id, measurement_id, company_id)
VALUES ('$weightGoal', '$startWeight', '$startDate', Null, NULL , '$userId', '$weightId', '$company_id')";
    $result = $db_connection->executeStatement($insert);
    if (!$result) {
        $error = false;
    }

} else {

    $update = "UPDATE goal set goal_value='$weightGoal',start_value='$startWeight', startdate='$startDate'
WHERE user_id='$userId' AND measurement_id='$weightId' and company_id='$company_id'";
    $result = $db_connection->executeStatement($update);

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