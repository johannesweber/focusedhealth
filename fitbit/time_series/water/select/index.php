<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 13:52
 */


include '../../../../db_connection.php';


$db_connection = new DatabaseConnection();

$db_connection->connect();


include '../../../id/find_water_id.php';


//$fetch = "SELECT value, date FROM value WHERE user_id='42' AND measurement_id = '$waterId'";


$fetch = "SELECT value, date, waterUnit
        FROM value
        JOIN company_account_info AS cci on value.user_id = cci.user_id
        WHERE value.user_id='42' AND value.measurement_id = '$waterId'";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


print_r($result);
?>