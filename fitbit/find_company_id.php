<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 22:19
 */

include_once 'db_connection.php';

$find_company_id_statement = "SELECT id FROM company WHERE name='fitbit'";

$sql_result = mysqli_query($db_connection,$find_company_id_statement);

$result = mysqli_fetch_array($sql_result, MYSQL_ASSOC);

$company_id = $result['id'];

?>