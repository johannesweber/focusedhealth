<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 14:59
 */


$timeStamp = time();
$date = date("Y-m-d", $timeStamp);

//TODO real User id required
$fetch_user_info = "SELECT value, date
        FROM value
        WHERE value.user_id='$userId' AND value.date='$date' AND ( measurement_id = '$bicep' OR measurement_id = '$calfId'
    OR measurement_id = '$chestId' OR measurement_id = '$forearmId' OR measurement_id = '$hipsId' OR measurement_id = '$neckId'
OR measurement_id = '$thighId' OR measurement_id = '$waistId')";

$db_connection->executeStatement($fetch_user_info);

echo $db_connection->getResultAsJSON();


?>



