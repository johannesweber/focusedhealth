<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 14:59
 */

//TODO real User id required
$fetch_user_info = "SELECT * FROM company_account_info WHERE user_id='42'";

$db_connection->executeStatement($fetch_user_info);

echo $db_connection->getResultAsJSON();