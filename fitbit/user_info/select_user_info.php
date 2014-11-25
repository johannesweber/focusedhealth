<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 18.11.14
 * Time: 13:39
 */

//TODO real User id required
$fetch_user_info = "SELECT * FROM company_account_info WHERE user_id='42'";

$db_connection->executeStatement($fetch_user_info);

echo $db_connection->getResultAsJSON();