<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 12:12
 */

$userId = '42';

$timeStamp = time();
$date = date("Y-m-d", $timeStamp);

$limit = '7';


include '../../id/find_body_fat_id.php';


$fetch = "SELECT value, date
FROM value
WHERE value.user_id='$userId' AND value.measurement_id = '$fatId' AND date <= '$date'
ORDER BY date DESC
LIMIT $limit";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


echo($result);
?>
