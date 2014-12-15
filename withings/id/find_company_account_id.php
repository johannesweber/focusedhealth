<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 08.12.14
 * Time: 20:20
 */

$fetch = "SELECT company_account_id FROM company_account_info WHERE user_id='$userid' AND company_id = '$company_id'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$companyAccountId = $fetch_result['company_account_id'];