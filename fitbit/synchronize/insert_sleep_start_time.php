<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 08.12.14
 * Time: 17:33
 */


$response = $fitbit->getTimeSeries("startTime", "today", "7d");
$measurementName='sleepStartTime';
$sleepStartTimeId = $db_connection->getMeasurementId($measurementName);

$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

for ($x = 0; $x < $arrayLength; $x++) {

    $startTime = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $select = "SELECT * FROM sleep_start_time WHERE user_id='$userId' AND measurement_id='$sleepStartTimeId' AND company_id='$companyId' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);
    if (!$result) {
        $error = false;
    }
    $rowCount = $result->num_rows;

//sleep start time was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO sleep_start_time (user_id, measurement_id, company_id, start_time, date)
        VALUES ('$userId', '$sleepStartTimeId', '$companyId', '$startTime','$date')";

        $result = $db_connection->executeStatement($insert);

        if (!$result) {
            $error = false;
        }


    } else {

        $update = "UPDATE sleep_start_time SET start_time = '$startTime'
                                     WHERE user_id='$userId' AND measurement_id='$sleepStartTimeId' AND company_id='$companyId' AND date = '$date'";

        $result = $db_connection->executeStatement($update);

        if (!$result) {
            $error = false;
        }

    }

}

?>