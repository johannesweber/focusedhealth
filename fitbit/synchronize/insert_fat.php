<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 12:10
 */


$response = $fitbit->getTimeSeries("fat", "today", "7d");
$measurementName='bodyFat';
$fatId = $db_connection->getMeasurementId($measurementName);

$error = true;

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $fat = $array[$x]->value;
    $date = $array[$x]->dateTime;


    //SQL Statement to
    $select = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$fatId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);

    if (!$result) {
        $error = false;
    }
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$fatId', '$company_id', '$fat','$date')";

        $result = $db_connection->executeStatement($insert);
        if (!$result) {
            $error = false;
        }

    } else {

        $update = "UPDATE value SET value = '$fat'
                                     WHERE user_id='$userId' AND measurement_id='$fatId' AND company_id='$company_id' AND date = '$date'";

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