<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 18:00
 */



include '../../../../db_connection.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

include '../../../id/find_weight_id.php';





<<<<<<< HEAD
 $fetch_food = "SELECT value, date FROM value WHERE user_id='42' AND measurement_id = '$weightId'";

$db_connection->executeStatement($fetch_food);
 $result = $db_connection->getResultAsJSON();

print_r( $result);
=======
// $fetch = "SELECT value, date FROM value WHERE user_id='42' AND measurement_id = '$weightId'";


$fetch = "SELECT value, date, weightUnit
        FROM value
        JOIN company_account_info AS cci on value.user_id = cci.user_id
        WHERE value.user_id='42' AND value.measurement_id = '$weightId'";

$db_connection->executeStatement($fetch);
 $result = $db_connection->getResultAsJSON();

print_r( $result);
?>
>>>>>>> FETCH_HEAD
