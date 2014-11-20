<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 22:19
 */

$find_company_id_statement = "SELECT id FROM company WHERE name='fitbit'";

$result = $db_connection->executeStatement($find_company_id_statement);

$company_id = $result['id'];

?>