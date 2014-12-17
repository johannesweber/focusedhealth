<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 *
 *insert awakenings count of a specific time range
 */


//Request for time series awakenings count
$response = $fitbit->getTimeSeries("awakeningsCount", "today", "7d");
//print_r($response);
$awakeningsCountId = getMeasurementId("awakeningsCount", $db_connection);

$error = true;

//length of response array
$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

//loop to insert all data from response array
for ($x = 0;
     $x < $arrayLength;
     $x++) {

    $awakeningsCount = $array[$x]->value;
    $date = $array[$x]->dateTime;


//SQL Statement to check if this data set already exists for this day
    $select = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$awakeningsCountId' AND company_id='$company_id' AND date= '$date' ";

    $result = $db_connection->executeStatement($select);
    if (!$result) {
        $error = false;
    }

    $rowCount = $result->num_rows;

//awakenigns count was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into table called "value"
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$awakeningsCountId', '$company_id', '$awakeningsCount','$date')";

        $result = $db_connection->executeStatement($insert);

        if (!$result) {
            $error = false;
        }

//awakenings count was already inserted today
    } else {
//SQL Statement to update data
        $update = "UPDATE value SET value = '$awakeningsCount'
                                     WHERE user_id='$userId' AND measurement_id='$awakeningsCountId' AND company_id='$company_id' AND date = '$date'";

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

