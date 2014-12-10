<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:07
 */


$fetch = "SELECT goal_value, start_value, startdate FROM goal WHERE user_id='$userId' AND period = '$periodDailyId'";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


echo($result);

?>