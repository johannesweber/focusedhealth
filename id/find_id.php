<?php

/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 17.12.14
 * Time: 09:50
 */

/*
 * function to find the measurment Id's by name
 */
function getMeasurementId($measurementName, $db_connection)
{
    $fetch = "SELECT id FROM measurement WHERE name='$measurementName'";

    $db_connection->executeStatement($fetch);
    $fetch_result = $db_connection->getResultAsArray();

    return $measurementId = $fetch_result['id'];
}

?>
