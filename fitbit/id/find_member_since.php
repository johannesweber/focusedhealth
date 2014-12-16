<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 16.12.14
 * Time: 10:59
 */



$fetch = "SELECT * FROM company_account_info WHERE user_id ='$userId' and company_id = '1' ";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();


$memberSince = $fetch_result['memberSince'];



?>