<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */


//Request for activity daily goals
$response = $fitbit->getActivityDailyGoals();

$error = true;

$distanceId = getMeasurementId("distance", $db_connection);
$activeMinutesId = getMeasurementId("activeMinutes", $db_connection);
$caloriesOutId = getMeasurementId("caloriesOut", $db_connection);
$stepsId = getMeasurementId("steps", $db_connection);
$periodDailyId = getMeasurementId("daily", $db_connection);

//access data of response
$activeMinutes = $response->goals->activeMinutes;
$caloriesOut = $response->goals->caloriesOut;
$distance = $response->goals->distance;
$steps = $response->goals->steps;


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

// run through each value
for ($id = 0; $id < sizeof($idArray); $id++) {

    $ID = $idArray[$id];
    $wert = $werteArray[$id];


//SQL Statement to check if this data set already exists
    $select = "SELECT * FROM goal WHERE user_id='$userId' AND measurement_id='$ID' AND company_id='$company_id' AND period= '$periodDailyId'";
    $result = $db_connection->executeStatement($select);

    if (!$result) {
        $error = false;
    }
    $rowCount = $result->num_rows;


//activity daily goal data set is not inserted yet
    if ($rowCount == 0) {
        $insert_activity_daily_goals = "INSERT INTO goal (goal_value, startdate, enddate, period, user_id, measurement_id, company_id)
         VALUES ('$wert', Null, Null, '$periodDailyId', '$userId', '$ID', '$company_id')";

        $result = $db_connection->executeStatement($insert_activity_daily_goals);

        if (!$result) {
            $error = false;
        }
    } else {
        //SQL Statement to update data
        $update = "UPDATE goal set goal_value='$wert', startdate=NULL, enddate=NULL, period='$periodDailyId',
                                    user_id='$userId', measurement_id='$ID', company_id='$company_id'
                                     WHERE user_id='$userId' AND measurement_id='$ID' AND company_id='$company_id' AND period='$periodDailyId'";

        $result = $db_connection->executeStatement($update);

        if (!$result) {
            $error = false;
        }

    }

}

if (!$error) {
    echo '{"success" : "-1", "message" : "steps statement was not successfull"}';
} else {
    echo '{"success" : "1", "message" : "steps statement was successfull"}';
}

?>
