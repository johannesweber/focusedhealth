<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:05
 */
/**
 * this class gets all important credentials from fitbit. This credentials are required to send Requests to Fitbit API
 *
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 22:03
 */

//TODO user id from focusedhealth required
$fetch_waterId = "SELECT id FROM measurement WHERE name='Water'";

$fetch_waterId_mysqli_result = $db_connection->executeStatement($fetch_waterId);
$fetch_waterId_result = $db_connection->getResultAsArray();


$waterId = $fetch_waterId_result['id'];



?>