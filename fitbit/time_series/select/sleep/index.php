<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 05.12.14
 * Time: 12:22
 */



$timeStamp = time();
$date = date("Y-m-d", $timeStamp);

include '../../../../db_connection.php';


$db_connection = new DatabaseConnection();

$db_connection->connect();


include '../../../id/find_time_in_bed_id.php';
include '../../../id/find_minutes_a_sleep_id.php';
include '../../../id/find_awakenings_count_id.php';
include '../../../id/find_minutes_awake_id.php';
include '../../../id/find_minutes_to_fall_asleep_id.php';

$fetch = "SELECT value, date
        FROM value
        WHERE value.user_id='$userId' AND value.date='$date' AND (measurement_id = '$sleepStartTime' OR measurement_id = '$timeInBedId' OR measurement_id = '$minutesAsleepId'
        OR measurement_id = '$awakeningsCountId' OR measurement_id = '$minutesAwakeId' OR measurement_id = '$minutesToFallAsleepId')";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


echo($result);




/*


//mit measurement !!!!
SELECT value,date,name
FROM value
JOIN measurement AS m on value.measurement_id = m.id
WHERE value.user_id='$userId' AND value.date='2014-12-04' AND ( measurement_id = '33' OR measurement_id = '52')



*/



?>