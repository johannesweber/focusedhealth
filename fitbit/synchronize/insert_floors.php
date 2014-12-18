<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 15:51
 */


$response = $fitbit->getTimeSeries("floors", "today", "7d");

$measurementName='floors';
$floorsId = $db_connection->getMeasurementId($measurementName);

$error = true;

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $floors = $array[$x]->value;
    $date = $array[$x]->dateTime;


    //SQL Statement to
    $select = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$floorsId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);

    if (!$result) {
        $error = false;
    }
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$floorsId', '$company_id', '$floors','$date')";

        $result = $db_connection->executeStatement($insert);
        if (!$result) {
            $error = false;
        }


    } else {

        $update_weight = "UPDATE value set value = '$floors'
                                     WHERE user_id='$userId' AND measurement_id='$floorsId' AND company_id='$company_id' AND date = '$date'";

        $result = $db_connection->executeStatement($update_weight);
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