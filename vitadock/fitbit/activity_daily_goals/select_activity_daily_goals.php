<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:07
 */

include '../id/find_period_daily_id.php';


$fetch = "SELECT goal_value, start_value, startdate FROM goal WHERE user_id='42' AND period = '$periodDailyId'";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


echo($result);

?>