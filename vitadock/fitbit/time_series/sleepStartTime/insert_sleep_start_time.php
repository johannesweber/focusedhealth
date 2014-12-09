<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 08.12.14
 * Time: 17:33
 */


include '../../id/find_company_id.php';
include '../../id/find_sleep_start_time_id.php';



$response = $fitbit->getTimeSeries("startTime","today","7d");
print_r($response);




$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

for ($x = 0; $x < $arrayLength; $x++) {

    $startTime = $array[$x]->value;
    $date = $array[$x]->dateTime;




    //SQL Statement to
    $select = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$sleepStartTimeId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$sleepStartTimeId', '$company_id', '$startTime','$date')";

        $db_connection->executeStatement($insert);


    }  else {

        $update = "UPDATE value SET value = '$startTime'
                                     WHERE user_id='42' AND measurement_id='$sleepStartTimeId' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update);


    }

}

?>