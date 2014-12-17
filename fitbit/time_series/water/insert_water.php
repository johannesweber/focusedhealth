<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 13:52
 */


$response = $fitbit->getTimeSeries("water", "today", "7d");

$waterId = getMeasurementId("water", $db_connection);

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $water = $array[$x]->value;
    $date = $array[$x]->dateTime;


    //SQL Statement to
    $select_water = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$waterId' AND company_id='$company_id' AND date= '$date' ";


    $result = $db_connection->executeStatement($select_water);
    $rowCount = $result->num_rows;

//water was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert_water = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$waterId', '$company_id', '$water','$date')";

        $db_connection->executeStatement($insert_water);


    } else {


        $update = "UPDATE value SET value = '$water'
                                     WHERE user_id='$userId' AND measurement_id='$waterId' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update);


    }

}

?>