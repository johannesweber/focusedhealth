<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 */


$response = $fitbit->getTimeSeries("minutesAwake", "today", "7d");
print_r($response);
$minutesAwakeId = getMeasurementId("minutesAwake", $db_connection);

$error = true;

$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

for ($x = 0; $x < $arrayLength; $x++) {

    $minutesAwake = $array[$x]->value;
    $date = $array[$x]->dateTime;


    //SQL Statement to
    $select = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$minutesAwakeId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);

    if (!$result) {
        $error = false;
    }
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$minutesAwakeId', '$company_id', '$minutesAwake','$date')";

        $result = $db_connection->executeStatement($insert);
        if (!$result) {
            $error = false;
        }


    } else {

        $update = "UPDATE value SET value = '$minutesAwake'
                                     WHERE user_id='$userId' AND measurement_id='$minutesAwakeId' AND company_id='$company_id' AND date = '$date'";

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