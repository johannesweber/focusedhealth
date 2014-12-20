<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 13:52
 */


$response = $fitbit->getTimeSeries("water", "today", "7d");

$measurementName='water';
$waterId = $db_connection->getMeasurementId($measurementName);

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $water = $array[$x]->value;
    $date = $array[$x]->dateTime;


    //SQL Statement to
    $select = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$waterId' AND company_id='$companyId' AND date= '$date' ";


    $result = $db_connection->executeStatement($select);

    if (!$result) {
        $error = false;
    }

    $rowCount = $result->num_rows;

//water was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$waterId', '$companyId', '$water','$date')";

        $result = $db_connection->executeStatement($insert);

        if (!$result) {
            $error = false;
        }

    } else {


        $update = "UPDATE value SET value = '$water'
                                     WHERE user_id='$userId' AND measurement_id='$waterId' AND company_id='$companyId' AND date = '$date'";

        $result = $db_connection->executeStatement($update);


        if (!$result) {
            $error = false;
        }

    }

}

?>