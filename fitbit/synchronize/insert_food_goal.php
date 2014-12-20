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


// to get the Id's for the measurement name
$measurementName = 'calories';
$caloriesId = $db_connection->getMeasurementId($measurementName);
$measurementName = 'daily';
$periodDailyId = $db_connection->getMeasurementId($measurementName);


$foodGoal = $response->goals->calories;


//SQL Statement to check if this data set already exists
$select = "SELECT * FROM goal WHERE user_id='$userId' AND measurement_id='$caloriesId' AND company_id='$companyId'";
$result = $db_connection->executeStatement($select);
if (!$result) {
    $error = false;
}
$rowCount = $result->num_rows;

if ($rowCount == 0) {

    $insert_food_goal = "INSERT INTO goal (goal_value, startdate, enddate, period, user_id, measurement_id, company_id)
         VALUES ('$foodGoal', Null, Null, '$periodDailyId', '$userId', '$caloriesId', '$companyId')";
    $db_connection->executeStatement($insert_food_goal);

    //food goal was already inserted
} else {

    $update = "UPDATE goal set goal_value='$foodGoal', startdate=NULL, enddate=NULL, period='$periodDailyId',
                                    user_id='$userId', measurement_id='$caloriesId', company_id='$companyId'
                                     WHERE user_id='$userId' AND measurement_id='$caloriesId' and company_id='$companyId'";
    $result = $db_connection->executeStatement($update);
    if (!$result) {
        $error = false;
    }
}

?>
