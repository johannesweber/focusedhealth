<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 16:04
 */


$response = $fitbit->getTimeSeries("elevation", "today", "7d");
$measurementName='elevation';
$elevationId = $db_connection->getMeasurementId($measurementName);

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $elevation = $array[$x]->value;
    $date = $array[$x]->dateTime;


    //SQL Statement to
    $select = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$elevationId' AND company_id='$companyId' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);

    if (!$result) {
        $error = false;
    }

    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$elevationId', '$companyId', '$elevation','$date')";

        $result = $db_connection->executeStatement($insert);

        if (!$result) {
            $error = false;
        }

    } else {

        $update = "UPDATE value SET value = '$elevation'
                                     WHERE user_id='$userId' AND measurement_id='$elevationId' AND company_id='$companyId' AND date = '$date'";

        $result = $db_connection->executeStatement($update);
        if (!$result) {
            $error = false;
        }

    }

}

?>