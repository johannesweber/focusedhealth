<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 16:20
 */


$response = $fitbit->getTimeSeries("minutesSedentary", "today", "7d");
print_r($response);
$sedentaryId = getMeasurementId("sedentary", $db_connection);

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $sedentary = $array[$x]->value;
    $date = $array[$x]->dateTime;


    //SQL Statement to
    $select = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$sedentaryId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$sedentaryId', '$company_id', '$sedentary','$date')";

        $db_connection->executeStatement($insert);


    } else {

        $update = "UPDATE value SET value = '$sedentary'
                                     WHERE user_id='$userId' AND measurement_id='$sedentaryId' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update);


    }

}

?>