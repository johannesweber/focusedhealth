<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:07
 */


$fetch_food_goal = "SELECT goal_value, startdate, enddate FROM goal WHERE user_id='$userId' AND measurement_id='$caloriesId'";

$db_connection->executeStatement($fetch_food_goal);

echo $db_connection->getResultAsJSON();