<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 17:22
 */

include '../../id/find_company_id.php';
include '../../id/find_time_in_bed_id.php';



$response = $fitbit->getTimeSeries("timeInBed","today","7d");
print_r($response);




$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

for ($x = 0; $x < $arrayLength; $x++) {

    $timeInBed = $array[$x]->value;
    $date = $array[$x]->dateTime;




    //SQL Statement to
    $select = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$timeInBedId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$timeInBedId', '$company_id', '$timeInBed','$date')";

        $db_connection->executeStatement($insert);


    }  else {

        $update = "UPDATE value SET value = '$timeInBed'
                                     WHERE user_id='42' AND measurement_id='$timeInBedId' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update);

    }

}

?>