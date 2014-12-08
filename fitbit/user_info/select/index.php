<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 18.11.14
 * Time: 13:39
 */





include '../../../db_connection.php';


$db_connection = new DatabaseConnection();

$db_connection->connect();



$fetch = "SELECT * FROM company_account_info WHERE user_id='42'";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


print_r($result);





?>