<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */


$response = $fitbit->getActivityWeeklyGoals();

// to get the Id's for the measurement name
$measurementName = 'distance';
$distanceId = $db_connection->getMeasurementId($measurementName);
$measurementName = 'steps';
$stepsId = $db_connection->getMeasurementId($measurementName);
$measurementName = 'weekly';
$periodWeeklyId = $db_connection->getMeasurementId($measurementName);


$distance = $response->goals->distance;
$steps = $response->goals->steps;


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
    $select = "SELECT * FROM goal WHERE user_id='$userId' AND measurement_id='$ID' AND company_id='$companyId' AND period= '$periodWeeklyId'";
    $result = $db_connection->executeStatement($select);

    if (!$result) {
        $error = false;
    }

    $rowCount = $result->num_rows;

    //weekly goal is not inserted yet
    if ($rowCount == 0) {
        $insert = "INSERT INTO goal (goal_value, startdate, enddate, period, user_id, measurement_id, company_id)
         VALUES ('$wert', Null, Null, '$periodWeeklyId', '$userId', '$ID', '$companyId')";

        $result = $db_connection->executeStatement($insert);

        if (!$result) {
            $error = false;
        }

        //weekly goal was already inserted
    } else {
        $update_activity_daily_goals = "UPDATE goal set goal_value='$wert', startdate=NULL, enddate=NULL, period='$periodWeeklyId',
                                    user_id='$userId', measurement_id='$ID', company_id='$companyId'
                                     WHERE user_id='$userId' AND measurement_id='$ID' AND company_id='$companyId' AND period='$periodWeeklyId'";

        $result = $db_connection->executeStatement($update_activity_daily_goals);

        if (!$result) {
            $error = false;
        }
    }
}
?>
