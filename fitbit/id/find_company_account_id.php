<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 07.12.14
 * Time: 12:36
 */

$find_company_account_id_statement = "SELECT company_account_id FROM user_company_account WHERE user_id='42'";

$find_company_account_id_mysqli_result = $db_connection->executeStatement($find_company_account_id_statement);

$find_company_account_id_result = $db_connection->getResultAsArray();

$companyAccountId = $find_company_account_id_result['company_account_id'];

?>