<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 05.12.14
 * Time: 10:56
 */

$userId = '42';

$timeStamp = time();
$date = date("Y-m-d", $timeStamp);

include '../id/find_weight_id.php';

$fetch = "SELECT activity, date, start_time, duration, distance, calories, description FROM activity WHERE user_id='$userId' AND date='$date' ";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();

echo($result);

?>