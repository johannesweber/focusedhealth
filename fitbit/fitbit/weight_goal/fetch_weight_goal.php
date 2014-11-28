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
 * User: patricauer
 * Date: 25.11.14
 * Time: 18:05
 */

include 'find_company_id.php';

//TODO user id from focusedhealth required
$fetch_weightId = "SELECT id FROM measurement WHERE name='Weight'";

$fetch_weightId_mysqli_result = $db_connection->executeStatement($fetch_weightId);
$fetch_weightId_result = $db_connection->getResultAsArray();


$caloriesId = $fetch_weightId_result['id'];



?>