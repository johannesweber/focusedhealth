<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 18:00
 */


$userId = '42';

$timeStamp = time();
$date = date("Y-m-d", $timeStamp);

$limit = '7';


include '../../id/find_elevation_id.php';


$fetch = "SELECT value, date, distanceUnit AS elevationUnit
FROM value
JOIN company_account_info AS cai on value.user_id = cai.user_id
WHERE value.user_id='$userId' AND value.measurement_id = '$elevationId' AND date <= '$date'
ORDER BY date DESC
LIMIT $limit";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


echo($result);


?>
