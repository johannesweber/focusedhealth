<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 *
 * to insert weight goal
 */


$response = $fitbit->getWeightGoal();

$weightGoal = $response->goal->weight;
$startDate = $response->goal->startDate;
$startWeight = $response->goal->startWeight;

// to get the name for the measurement
$measurementName='weight';
$weightId = $db_connection->getMeasurementId($measurementName);
$period='daily';
$periodDailyId = $db_connection->getPeriodId($period);

//check if weight goal already exists
$select_weight_goal = "SELECT * FROM goal WHERE user_id='$userId' AND measurement_id='$weightId' AND company_id='$companyId'";
$result = $db_connection->executeStatement($select_weight_goal);
$rowCount = $result->num_rows;

if ($rowCount == 0) {
    //insert weight goal
    $insert = "INSERT INTO goal (goal_value, start_value, startdate, enddate, period, user_id, measurement_id, company_id)
VALUES ('$weightGoal', '$startWeight', '$startDate', 0, NULL , '$userId', '$weightId', '$companyId')";
    $result = $db_connection->executeStatement($insert);
    if (!$result) {
        $error = false;
    }

} else {
//update weight goal
    $update = "UPDATE goal set goal_value='$weightGoal',start_value='$startWeight', startdate='$startDate'
WHERE user_id='$userId' AND measurement_id='$weightId' and company_id='$companyId'";
    $result = $db_connection->executeStatement($update);

    if (!$result) {
        $error = false;
    }
}

?>