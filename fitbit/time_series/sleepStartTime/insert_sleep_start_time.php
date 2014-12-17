<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 08.12.14
 * Time: 17:33
 */


$response = $fitbit->getTimeSeries("startTime", "today", "7d");
print_r($response);
$sleepStartTimeId = getMeasurementId("sleepStartTime", $db_connection);

$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

for ($x = 0; $x < $arrayLength; $x++) {

    $startTime = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $select = "SELECT * FROM sleep_start_time WHERE user_id='$userId' AND measurement_id='$sleepStartTimeId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);
    $rowCount = $result->num_rows;

//sleep start time was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO sleep_start_time (user_id, measurement_id, company_id, start_time, date)
        VALUES ('$userId', '$sleepStartTimeId', '$company_id', '$startTime','$date')";

        $db_connection->executeStatement($insert);


    } else {

        $update = "UPDATE value SET start_time = '$startTime'
                                     WHERE user_id='$userId' AND measurement_id='$sleepStartTimeId' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update);


    }

}

?>