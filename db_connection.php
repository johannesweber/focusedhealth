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
        print_r($result);
        echo "Company ID: " . $companyId = $result["id"];
        return $companyId;

    }

    public function getMemberSince($userId, $company) {

        $select = 'memberSince';

        $this->getFromCompanyAccountInfo($select, $userId, $company);
    }

    /*
    * function to find select everything from company account info
    */
    public function getFromCompanyAccountInfo($select, $userId, $companyId)
    {
        $this->connect();

        $fetch = "SELECT * FROM company_account_info WHERE user_id ='$userId' and company_id = '$companyId'";

        $this->executeStatement($fetch);
        $result = $this->getResultAsArray();
        $selectValue = $result[$select];

        return $selectValue;
    }

    /*
     * function to
     */
    public function selectGoalFromDatabase($measurement, $userId, $period) {

        $this->connect();

        $measurementId = $this->getMeasurementId($measurement);

        $statement = "SELECT goal_value, start_value, startdate
                            FROM goal
                            JOIN measurement meas ON goal.measurement_id = meas.id
                            JOIN unit ON meas.unit_id = unit.id
                            WHERE user_id= $userId
                            AND measurement_id= $measurementId
                            AND period = $period
                      ";

        echo $statement;


        $this->executeStatement($statement);

        echo $this->getResultAsJSON();
    }

    /*
     * function to ???
     */
    public function selectValueFromDatabase($measurement, $userId, $date, $limit) {

        $this->connect();

        $measurementId = $this->getMeasurementId($measurement);

        $statement = "SELECT value, DATE, meas.name AS measurement, unit.name AS unit
                      FROM value val
                      JOIN measurement meas ON val.measurement_id = meas.id
                      JOIN unit ON meas.unit_id = unit.id
                      WHERE user_id =  '$userId'
                      AND measurement_id =  '$measurementId'
                      AND DATE <=  '$date'
                      ORDER BY date DESC
                      LIMIT $limit
                      ";

        $this->executeStatement($statement);

        echo $this->getResultAsJSON();
    }

    //return number of rows
    public function checkIfvalueExists($userId, $measurementId, $companyId, $date)
    {
        $this->connect();

        $statement = "SELECT * FROM value WHERE user_id = '$userId' AND measurement_id = '$measurementId' AND company_id = '$companyId' AND date = '$date' ";

        $result = $this->executeStatement($statement);

        echo $rowCount = $result->num_rows;
    }


}

?>
