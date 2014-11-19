<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 18.11.14
 * Time: 13:39
 */

include_once '../db_connection.php';

//TODO real User id required
$fetch_user_info = "SELECT * FROM company_account_info WHERE fh_user_id='42'";

$sql_result = mysqli_query($db_connection,$fetch_user_info);

$result = mysqli_fetch_array($sql_result, MYSQL_ASSOC);

echo "Encoded ID: ".$result['encodedId'];