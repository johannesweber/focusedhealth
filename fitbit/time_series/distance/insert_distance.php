<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 15:17
 */


$response = $fitbit->getTimeSeries("distance", "today", "7d");
print_r($response);
$distanceId = getMeasurementId("distance", $db_connection);

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $distance = $array[$x]->value;
    $date = $array[$x]->dateTime;


    //SQL Statement to
    $select = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$distanceId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert_bmi = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$distanceId', '$company_id', '$distance','$date')";

        $db_connection->executeStatement($insert_bmi);


    } else {

        $update = "UPDATE value SET value = '$distance'
                                     WHERE user_id='$userId' AND measurement_id='$distanceId' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update);


    }

}

?>