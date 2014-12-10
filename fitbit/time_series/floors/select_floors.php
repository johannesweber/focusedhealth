<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 18:00
 */



$timeStamp = time();
$date = date("Y-m-d", $timeStamp);

$limit = '30';


include '../../id/find_floors_id.php';


$fetch = "SELECT value, date
FROM value
WHERE value.user_id='$userId' AND value.measurement_id = '$floorsId' AND date <= '$date'
ORDER BY date DESC
LIMIT $limit";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


echo($result);
?>

