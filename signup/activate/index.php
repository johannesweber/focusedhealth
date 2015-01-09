<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 10.12.14
 * Time: 21:45
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

if($_REQUEST['email'] && $_REQUEST['verifier']) {

    $email = $_REQUEST['email'];
    $verifier = $_REQUEST['verifier'];

    $dbConnection = new DatabaseConnection();

    $dbConnection->connect();

    $select_user = "SELECT * FROM user WHERE email = '$email' AND verifier = '$verifier'";

    $dbConnection->executeStatement($select_user);

    $result = $dbConnection->getResult();

    $resultArray = $dbConnection->getResultAsArray();

    $userId = $resultArray["id"];
    $company = 'focused health';
    $companyId = $dbConnection->getCompanyId($company);
    $company_account_id = $userId;
    $timestamp = time();
    $memberSince = date("Y-m-d", $timestamp);

    if (mysqli_num_rows($result) > 0) {

        $set_user_active = "UPDATE user SET active = 'Yes' WHERE email = '$email'";

        $dbConnection->executeStatement($set_user_active);

        $addFocusedHealthCompanyToUser = "INSERT INTO user_company_account (user_id, company_id, company_account_id, timestamp)
                                          VALUES ($userId, $companyId, $company_account_id, '$memberSince')";

        $dbConnection->executeStatement($addFocusedHealthCompanyToUser);

        echo "Congratulations!. You have succesfully activated your Focused Health Account.";
    }

    $dbConnection->close();
}

?>