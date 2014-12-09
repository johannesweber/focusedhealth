<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 18.11.14
 * Time: 13:39
 */

include '../id/find_company_account_id.php';

//TODO real User id required
$fetch_user_info = "SELECT city, country, dateOfBirth, gender, height, memeberSince, timzone FROM company_account_info WHERE company_account_id='$companyAccountId'";

$db_connection->executeStatement($fetch_user_info);

echo $db_connection->getResultAsJSON();