<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 13.01.15
 * Time: 14:41
 */

header('Content-type: application/json; charset=utf-8');

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../db_connection.php';

$db_connection = new DatabaseConnection();

$company = $_GET['company'];
$measurement = $_GET['measurement'];

$companyHasMeasurement = $db_connection->selectCompanyHasMeasurement();

echo '{"companyHasMeasurement" : "' . $companyHasMeasurement . '"}';

$db_connection->close();

?>