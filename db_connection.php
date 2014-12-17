<?php

/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 10:30
 */
class DatabaseConnection
{

    protected $db_connection;
    protected $result;

    public function __construct()
    {

        define ("MYSQL_HOST", "localhost");
        define ("MYSQL_USER", "5ive");
        define ("MYSQL_PASSWORD", "team5ivemysql");
        define ("MYSQL_DATABASE", "healthhub");

    }

    public function connect()
    {

        $this->db_connection = mysqli_connect(MYSQL_HOST,
            MYSQL_USER,
            MYSQL_PASSWORD,
            MYSQL_DATABASE
        );

        if (!$this->db_connection) {
            echo 'Connection failed';
        }
    }

    public function executeStatement($statement)
    {

        $db_result = mysqli_query($this->db_connection, $statement);

        if (!$db_result) {
            die('Invalid Statement: ' . mysqli_error($this->db_connection));
        }

        $this->result = $db_result;

        return $db_result;
    }

    public function close()
    {

        mysqli_close($this->db_connection);
    }

    public function getResultAsArray()
    {

        $resultArray = mysqli_fetch_array($this->result, MYSQL_ASSOC);
        return $resultArray;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function getResultAsJSON()
    {

        $data = array();

        for ($x = 0; $x < mysqli_num_rows($this->result); $x++) {
            $data[] = mysqli_fetch_assoc($this->result);
        }

        return json_encode($data);
    }

    /*
     * function to find the measurment Id's by name
     */
    public function getMeasurementId($measurementName)
    {
        $this->connect();

        $fetch = "SELECT id FROM measurement WHERE name='$measurementName'";

        $this->executeStatement($fetch);
        $result = $this->getResultAsArray();
        $measurementId = $result['id'];
        return $measurementId;
    }


    /*
    * function to
    */
    public function getCompanyAccountIdAndMemberSinceFromCompanyAccountInfo($userId, $company_id)
    {
        $this->connect();

        $fetch = "SELECT * FROM company_account_info WHERE user_id ='$userId' and company_id = '$company_id'";

        $this->executeStatement($fetch);
        $result = $this->getResultAsArray();
        $companyAccountId = $result['company_account_id'];
        $memberSince = $result['memberSince'];
        return $companyAccountId;
    }

    public function selectValueFromDatabase($measurementId, $userId, $date, $limit)
    {

        $this->connect();

        $statement = "SELECT value, date FROM value WHERE value.user_id='$userId' AND value.measurement_id = '$measurementId' AND date <= '$date' ORDER BY date DESC LIMIT $limit";

        $this->executeStatement($statement);

        echo $this->getResultAsJSON();
    }

    //return number of rows
    public function checkIfvalueExists($userId, $measurementId, $companyId, $date)
    {
        $this->connect();

        $statement = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$measurementId' AND company_id='$companyId' AND date= '$date' ";

        $result = $this->executeStatement($statement);

        echo $rowCount = $result->num_rows;
    }


}

?>
