<?php
/**
 *
 * This class is used to select the data from our database and provide it to our Mobile App.
 *
 * Created by PhpStorm.
 * User: pauer
 * Date: 05.01.15
 * Time: 08:50
 */


$timeStamp = time();
$date = date("Y-m-d", $timeStamp);

$statement = "SELECT value, date FROM value WHERE value.user_id = '$userId' AND value.date = '$date' AND (
                measurement_id = '$weightId' OR measurement_id = '$heightId'
    OR measurement_id = '$fatFreeMassId' OR measurement_id = '$fatId' OR measurement_id = '$fatMassId' OR measurement_id = '$diastolicId'
OR measurement_id = '$systolicId' OR measurement_id = '$heartRateId' OR measurement_id = 'spO2Id')";

$db_connection->executeStatement($statement);

echo $db_connection->getResultAsJSON();

?>