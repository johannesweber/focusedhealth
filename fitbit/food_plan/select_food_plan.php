<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 05.12.14
 * Time: 10:56
 */




$fetch = "SELECT calories_goal, start_date, estimate_date, intensity FROM food_plan WHERE user_id='$userId' ";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();

print_r($result);

?>