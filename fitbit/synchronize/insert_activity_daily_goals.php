<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */


//Request for activity daily goals
$response = $fitbit->getActivityDailyGoals();


// to get the Id's for the measurement name
$measurementName='distance';
$distanceId = $db_connection->getMeasurementId($measurementName);
$measurementName='activeMinutes';
$activeMinutesId = $db_connection->getMeasurementId($measurementName);
$measurementName='caloriesOut';
$caloriesOutId = $db_connection->getMeasurementId($measurementName);
$measurementName='steps';
$stepsId = $db_connection->getMeasurementId($measurementName);
$period = 'daily';
$periodDailyId = $db_connection->getPeriodId($period);


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
    $select = "SELECT * FROM goal WHERE user_id='$userId' AND measurement_id='$ID' AND company_id='$companyId' AND period= '$periodDailyId'";
    $result = $db_connection->executeStatement($select);

    if (!$result) {
        $error = false;
    }
    $rowCount = $result->num_rows;


//activity daily goal data set is not inserted yet
    if ($rowCount == 0) {
        $insert_activity_daily_goals = "INSERT INTO goal (goal_value, startdate, enddate, period, user_id, measurement_id, company_id)
         VALUES ('$wert', Null, Null, '$periodDailyId', '$userId', '$ID', '$companyId')";

        $result = $db_connection->executeStatement($insert_activity_daily_goals);

        if (!$result) {
            $error = false;
        }
    } else {
        //SQL Statement to update data
        $update = "UPDATE goal set goal_value='$wert', startdate=NULL, enddate=NULL, period='$periodDailyId',
                                    user_id='$userId', measurement_id='$ID', company_id='$companyId'
                                     WHERE user_id='$userId' AND measurement_id='$ID' AND company_id='$companyId' AND period='$periodDailyId'";

        $result = $db_connection->executeStatement($update);

        if (!$result) {
            $error = false;
        }

    }

}

?>
