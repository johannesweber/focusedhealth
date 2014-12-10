<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 10.12.14
 * Time: 22:46
 */

//TODO needs to be tested. Redirection to iPhone

$is_user_active = "SELECT active FROM user WHERE email = '$email'";

$dbConnection->executeStatement($is_user_active);

$result = $dbConnection->getResultAsArray();

$active = $result['active'];

?>