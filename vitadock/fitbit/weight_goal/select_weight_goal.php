<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:07
 */

include '../id/find_weight_id.php';


$fetch = "SELECT goal_value, start_value, startdate FROM goal WHERE user_id='42' AND measurement_id='$weightId' ";

$db_connection->executeStatement($fetch);

echo $db_connection->getResultAsJSON();
?>