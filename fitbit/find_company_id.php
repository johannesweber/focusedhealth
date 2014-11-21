<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 22:19
 */

$find_company_id_statement = "SELECT id FROM company WHERE name='fitbit'";

$find_company_id_mysqli_result = $db_connection->executeStatement($find_company_id_statement);

$find_company_id_result = mysqli_fetch_array( $find_company_id_mysqli_result, MYSQL_ASSOC);

$company_id = $find_company_id_result['id'];

?>