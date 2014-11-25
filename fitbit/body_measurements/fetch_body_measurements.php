<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 16:04
 */

/**
 * this class gets all important credentials from fitbit. This credentials are required to send Requests to Fitbit API
 *
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 22:03
 */

include 'find_company_id.php';

//TODO user id from focusedhealth required
$fetch_bicepId = "SELECT id FROM measurement WHERE name='Bicep'";
$fetch_bmiId = "SELECT id FROM measurement WHERE name='BMI'";
$fetch_calfId = "SELECT id FROM measurement WHERE name='Calf'";
$fetch_chestId = "SELECT id FROM measurement WHERE name='Chest'";
$fetch_fatId = "SELECT id FROM measurement WHERE name='Body Fat'";
$fetch_forearmId = "SELECT id FROM measurement WHERE name='Forearm'";
$fetch_hipsId = "SELECT id FROM measurement WHERE name='Hips'";
$fetch_neckId = "SELECT id FROM measurement WHERE name='Neck'";
$fetch_thighId = "SELECT id FROM measurement WHERE name='Thigh'";
$fetch_waistId = "SELECT id FROM measurement WHERE name='Waist'";
$fetch_weightId = "SELECT id FROM measurement WHERE name='Weight'";

$fetch_bicepId_mysqli_result = $db_connection->executeStatement($fetch_bicepId);
$fetch_bicepId_result = $db_connection->getResultAsArray();

$fetch_bmiId_mysqli_result = $db_connection->executeStatement($fetch_bmiId);
$fetch_bmiId_result = $db_connection->getResultAsArray();

$fetch_calfId_mysqli_result = $db_connection->executeStatement($fetch_calfId);
$fetch_calfId_result = $db_connection->getResultAsArray();

$fetch_chestId_mysqli_result = $db_connection->executeStatement($fetch_chestId);
$fetch_chestId_result = $db_connection->getResultAsArray();

$fetch_fatId_mysqli_result = $db_connection->executeStatement($fetch_fatId);
$fetch_fatId_result = $db_connection->getResultAsArray();

$fetch_forearmId_mysqli_result = $db_connection->executeStatement($fetch_forearmId);
$fetch_forearmId_result = $db_connection->getResultAsArray();

$fetch_hipsId_mysqli_result = $db_connection->executeStatement($fetch_hipsId);
$fetch_hipsId_result = $db_connection->getResultAsArray();

$fetch_neckId_mysqli_result = $db_connection->executeStatement($fetch_neckId);
$fetch_neckId_result = $db_connection->getResultAsArray();

$fetch_thighId_mysqli_result = $db_connection->executeStatement($fetch_thighId);
$fetch_thighId_result = $db_connection->getResultAsArray();

$fetch_waistId_mysqli_result = $db_connection->executeStatement($fetch_waistId);
$fetch_waistId_result = $db_connection->getResultAsArray();

$fetch_weightId_mysqli_result = $db_connection->executeStatement($fetch_weightId);
$fetch_weightId_result = $db_connection->getResultAsArray();

$bicepId = $fetch_bicepId_result['id'];
$bmiId = $fetch_bmiId_result['id'];
$calfId = $fetch_calfId_result['id'];
$chestId = $fetch_chestId_result['id'];
$fatId = $fetch_fatId_result['id'];
$forearmId = $fetch_forearmId_result['id'];
$hipsId = $fetch_hipsId_result['id'];
$neckId = $fetch_neckId_result['id'];
$thighId = $fetch_thighId_result['id'];
$waistId = $fetch_waistId_result['id'];
$weightId = $fetch_weightId_result['id'];


?>