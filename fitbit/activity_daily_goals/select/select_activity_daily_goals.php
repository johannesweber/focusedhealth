<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:07
 */

$fetch_weight_goal = "SELECT goal_value, start_value, startdate FROM goal WHERE user_id='42'";

$db_connection->executeStatement($fetch_weight_goal);

echo $db_connection->getResultAsJSON();