<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 */


$response = $fitbit->getTimeSeries("minutesToFallAsleep", "today", "7d");

$measurementName='minutesToFallAsleep';
$minutesToFallAsleepId = $db_connection->getMeasurementId($measurementName);

$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

for ($x = 0; $x < $arrayLength; $x++) {

    $minutesToFallAsleep = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $select = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$minutesToFallAsleepId' AND company_id='$companyId' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);
    if (!$result) {
        $error = false;
    }
    $rowCount = $result->num_rows;

//minutes to fall asleep was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$minutesToFallAsleepId', '$companyId', '$minutesToFallAsleep','$date')";

        $result = $db_connection->executeStatement($insert);

        if (!$result) {
            $error = false;
        }


    } else {

        $update = "UPDATE value SET value = '$minutesToFallAsleep'
                                     WHERE user_id='$userId' AND measurement_id='$minutesToFallAsleepId' AND company_id='$companyId' AND date = '$date'";

        $result = $db_connection->executeStatement($update);

        if (!$result) {
            $error = false;
        }

    }

}

?>