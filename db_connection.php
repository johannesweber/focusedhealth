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

    /*
     *
     */
    public function __construct()
    {

        define ("MYSQL_HOST", "localhost");
        define ("MYSQL_USER", "5ive");
        define ("MYSQL_PASSWORD", "team5ivemysql");
        define ("MYSQL_DATABASE", "healthhub");

    }

    /*
     * function to ????
     */
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

    /*
     * function to ????
     */
    public function executeStatement($statement)
    {

        $db_result = mysqli_query($this->db_connection, $statement);

        if (!$db_result) {
            die('Invalid Statement: ' . mysqli_error($this->db_connection));
        }

        $this->result = $db_result;

        return $db_result;
    }

    /*
     * function to ????
     */
    public function close()
    {

        mysqli_close($this->db_connection);
    }

    /*
     * function to ????
     */
    public function getResultAsArray()
    {

        $resultArray = mysqli_fetch_array($this->result, MYSQL_ASSOC);
        return $resultArray;
    }

    /*
     * function to ????
     */
    public function getResult()
    {
        return $this->result;
    }

    /*
     * function to???
     */
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
    public function getMeasurementId($measurement)
    {
        $this->connect();

        $fetch = "SELECT id FROM measurement WHERE name='$measurement'";

        $this->executeStatement($fetch);
        $result = $this->getResultAsArray();
        $measurementId = $result['id'];
        return $measurementId;
    }

    public function getPeriodId($period){

        $this->connect();

        $fetch = "SELECT id FROM period WHERE period='$period'";

        $this->executeStatement($fetch);
        $result = $this->getResultAsArray();
        $periodId = $result['id'];
        return $periodId;
    }

    /*
     * fuction to get the intern companyId from our database
     */
    public function getCompanyId($company)
    {

        $this->connect();

        $fetch = "SELECT id FROM company WHERE name='$company'";

        $this->executeStatement($fetch);
        $result = $this->getResultAsArray();
        $companyId = $result['id'];
        return $companyId;

    }

    /*
    * function to find the companyId and memberSince
    */
    public function getFromCompanyAccountInfo($select, $userId, $company_id)
    {
        $this->connect();

        $fetch = "SELECT * FROM company_account_info WHERE user_id ='$userId' and company_id = '$company_id'";

        $this->executeStatement($fetch);
        $result = $this->getResultAsArray();
        $selectValue = $result[$select];

        return $selectValue;
    }

    /*
     * function to
     */
    public function selectGoalFromDatabase($measurement, $userId, $period, $limit) {

        $this->connect();

        $timestamp = time();
        $date = date("Y-m-d", $timestamp);

        $measurementId = $this->getMeasurementId($measurement);
        //$companyId = $this->getCompanyId($company);

        $statement = "SELECT goal.goal_id, goal.goal_value AS target_value, v.value AS current_value, v.date
                      FROM goal
                      JOIN measurement meas ON goal.measurement_id = meas.id
                      JOIN unit ON meas.unit_id = unit.id
                      JOIN value v ON v.measurement_id = meas.id
                      WHERE goal.measurement_id = $measurementId
                      AND v.user_id = $userId
                      AND goal.period = $period
                      AND v.date <=  '$date'
                      ORDER BY DATE DESC
                      LIMIT $limit
                      ";
        $this->executeStatement($statement);

        return $this->getResultAsJSON();
    }

    /*
     * function to ???
     */
    public function selectValueFromDatabase($measurement, $userId, $date, $limit) {

        $this->connect();

        $measurementId = $this->getMeasurementId($measurement);

        $statement = "SELECT value, date, meas.name AS measurement, unit.name AS unit
                      FROM value val
                      JOIN measurement meas ON val.measurement_id = meas.id
                      JOIN unit ON meas.unit_id = unit.id
                      WHERE user_id =  '$userId'
                      AND measurement_id =  '$measurementId'
                      AND date <=  '$date'
                      ORDER BY date DESC
                      LIMIT $limit
                      ";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();
    }

    public function checkIfCredentialsExists($company, $userId) {

        $this->connect();

        $companyId = $this->getCompanyId($company);

        $statement = "SELECT * FROM user_company_account WHERE user_id = '$userId' AND company_id = $companyId";

        $result = $this->executeStatement($statement);

        $numberOfRows = $result->num_rows;

        if ($numberOfRows > 0) {
            $exists = true;
        } else {
            $exists = false;
        }

        return $exists;

    }

    //return number of rows
    public function checkIfvalueExists($userId, $measurementId, $companyId, $date)
    {
        $this->connect();

        $statement = "SELECT * FROM value WHERE user_id = '$userId' AND measurement_id = '$measurementId' AND company_id = '$companyId' AND date = '$date' ";

        $result = $this->executeStatement($statement);

        $numberOfRows = $result->num_rows;

        if ($numberOfRows > 0) {
            $exists = true;
        } else {
            $exists = false;
        }

        return $exists;
    }


}

?>
