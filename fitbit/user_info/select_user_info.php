<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 18.11.14
 * Time: 13:39
 *
 * to select all user infos
 */

//TODO real User id required
$fetch_user_info = "SELECT city, country, dateOfBirth, gender, height, memberSince, timezone FROM company_account_info WHERE company_account_id='$companyAccountId'";

$db_connection->executeStatement($fetch_user_info);

echo $result = $db_connection->getResultAsJSON();