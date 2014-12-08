<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:07
 */

include 'find_water_id.php';

//TODO real User id required
$select_water = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$waterId'";

$db_connection->executeStatement($select_water);

echo $db_connection->getResultAsJSON();
?>