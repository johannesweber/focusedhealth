<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 */




include '../../id/find_company_id.php';
include '../../id/find_minutes_to_fall_asleep_id.php';



$response = $fitbit->getTimeSeries("minutesAsleep","today","7d");
print_r($response);




$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

for ($x = 0; $x < $arrayLength; $x++) {

    $minutesToFallAsleep = $array[$x]->value;
    $date = $array[$x]->dateTime;




    $select = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$minutesToFallAsleepId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);
    $rowCount = $result->num_rows;

//minutes to fall asleep was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$minutesToFallAsleepId', '$company_id', '$minutesToFallAsleep','$date')";

        $db_connection->executeStatement($insert);


    }  else {

        $update = "UPDATE value SET value = '$minutesToFallAsleep'
                                     WHERE user_id='42' AND measurement_id='$minutesToFallAsleepId' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update);


    }

}

?>