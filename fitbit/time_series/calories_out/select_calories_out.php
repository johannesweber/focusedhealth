<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 14:28
 */


$timeStamp = time();
$date = date("Y-m-d", $timeStamp);

$limit = '30';


$fetch = "SELECT value, date
FROM value
WHERE value.user_id='$userId' AND value.measurement_id = '$caloriesOutId' AND date <= '$date'
ORDER BY date DESC
LIMIT $limit";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


echo($result);
?>
