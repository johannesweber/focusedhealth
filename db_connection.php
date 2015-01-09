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
     * function to connect to the database
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

    /**
     * function to ????
     * @param $statement
     * @return bool|mysqli_result
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
     * function to close the database connection
     */
    public function close()
    {
        mysqli_close($this->db_connection);
    }

    /**
     * function to ????
     * @return array|null
     */
    public function getResultAsArray()
    {

        $resultArray = mysqli_fetch_array($this->result, MYSQL_ASSOC);
        return $resultArray;
    }

    /**
     * function to ????
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * function to???
     * @return string
     */
    public function getResultAsJSON()
    {
        $data = array();

        for ($x = 0; $x < mysqli_num_rows($this->result); $x++) {
            $data[] = mysqli_fetch_assoc($this->result);
        }
        return json_encode($data);
    }

    /**
     * function to find the measurement Id's by name
     * @param $measurement
     * @return mixed
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

    /**
     * function to get the Id for the period. It's daily or weekly.
     * @param $period
     * @return mixed Id of the right period
     */
    public function getPeriodId($period)
    {
        $this->connect();

        $fetch = "SELECT id FROM period WHERE period='$period'";

        $this->executeStatement($fetch);
        $result = $this->getResultAsArray();
        $periodId = $result['id'];
        return $periodId;
    }

    /**
     * fuction to get the intern companyId from our database
     * @param $company
     * @return mixed Id of the right company
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

    /**
     * function to find the companyId and memberSince
     * @param $select
     * @param $userId
     * @param $company_id
     * @return mixed
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


    /**
     * @param $measurement
     * @param $userId
     * @param $period
     * @param $limit
     * @return string
     */
    public function selectGoalFromDatabase($measurement, $userId, $period, $limit)
    {
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


    /**
     * @param $company
     * @param $measurement
     * @param $userId
     * @param $date
     * @param $limit
     * @return string
     */
    public function selectValueFromDatabase($company, $measurement, $userId, $date, $limit)
    {
        $this->connect();

        $measurementId = $this->getMeasurementId($measurement);
        $companyId = $this->getCompanyId($company);

        if ($limit != 365) {

            $statement = "SELECT value, date, meas.name AS measurement, unit.name AS unit
                      FROM value val
                      JOIN measurement meas ON val.measurement_id = meas.id
                      JOIN unit ON meas.unit_id = unit.id
                      WHERE user_id =  '$userId'
                      AND company_id = '$companyId'
                      AND measurement_id =  '$measurementId'
                      AND date <=  '$date'
                      ORDER BY date DESC
                      LIMIT $limit
                      ";
        } else {

            $statement = "SELECT SUM(value) as value, date, meas.name AS measurement, unit.name AS unit
                      FROM value val
                      JOIN measurement meas ON val.measurement_id = meas.id
                      JOIN unit ON meas.unit_id = unit.id
                      WHERE user_id =  '$userId'
                      AND company_id = '$companyId'
                      AND measurement_id =  '$measurementId'
                      AND date <=  '$date'
					  GROUP BY Month(date)
					  ORDER BY date DESC
                      LIMIT $limit
                      ";
        }

        $this->executeStatement($statement);

        return $this->getResultAsJSON();
    }


    /**
     * function to check if goal exists in the database
     * @param $measurement
     * @param $userId
     * @param $company
     * @return bool true if desired goal is stored in database
     */
    public function checkIfGoalExists($measurement, $userId, $company)
    {
        $measurementId = $this->getMeasurementId($measurement);
        $companyId = $this->getCompanyId($company);

        $statement = "SELECT * FROM goal
                      WHERE user_id = '$userId'
                      AND measurement_id = '$measurementId'
                      AND company_id = '$companyId'";

        $result = $this->executeStatement($statement);

        $numberOfRows = $result->num_rows;

        if ($numberOfRows > 0) {

            $exists = true;

        } else {

            $exists = false;
        }

        return $exists;
    }


    /**
     * @param $company
     * @param $userId
     * @return bool
     */
    public function checkIfCredentialsExists($company, $userId)
    {
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


    /**
     * function to check if value exists in the database
     * @param $userId
     * @param $company
     * @param $measurement
     * @param $date
     * @param $limit
     * @return bool true if value is in Database
     */
    public function checkIfValueExists($userId, $company, $measurement, $date, $limit)
    {
        $this->selectValueFromDatabase($company, $measurement, $userId, $date, $limit);

        $numberOfRows = $this->result->num_rows;

        if ($numberOfRows > 0) {

            $exists = true;
        } else {

            $exists = false;
        }
        return $exists;
    }


    /**
     * @param $userId
     * @param $company
     * @param $measurement
     * @param $date
     * @param $value
     * @return bool
     */
    public function insertValue($userId, $company, $measurement, $date, $value)
    {
        $this->connect();

        $successfull = false;

        $measurementId = $this->getMeasurementId($measurement);
        $companyId = $this->getCompanyId($company);

        $valuesExists = $this->checkIfValueExists($userId, $company, $measurement, $date, $limit = 1);

        if ($valuesExists) {

            $statement = "UPDATE value SET value = '$value'
                          WHERE user_id = '$userId'
                          AND company_id = '$companyId'
                          AND measurement_id = '$measurementId'
                          AND date = '$date'
                          ";
        } else {

            $statement = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
                          VALUES ('$userId' , '$measurementId' , '$companyId', '$value' , '$date')
                          ";
        }
        $result = $this->executeStatement($statement);

        if ($result) {

            $successfull = true;
        }
        return $successfull;
    }


    /**
     * function to insert the information of sleep from withings in the database
     * @param $userId
     * @param $company
     * @param $measurement
     * @param $startTime
     * @param $endTime
     * @param $date
     * @return bool
     * wo ist das Update statement????
     */
    public function insertSleepStartTime($userId, $company, $measurement, $startTime, $endTime, $date)
    {
        $this->connect();

        $successfull = false;
        $result = false;
        $companyId = $this->getCompanyId($company);

        $valuesExists = $this->checkIfSleepTimeExists($userId, $company, $date, $startTime);

        if (!$valuesExists) {

            $statement = "INSERT INTO sleep_start_time (user_id, measurement_id,company_id, start_time, end_time, date)
                          VALUES ('$userId' , '$measurement' , '$companyId' ,'$startTime', '$endTime', '$date' )";
            $result = $this->executeStatement($statement);
        }

        if ($result) {

            $successfull = true;
        }
        return $successfull;
    }


    /**
     * function to check if sleep time exists in the database
     * @param $userId
     * @param $company
     * @param $date
     * @param $startTime
     * @return bool
     */
    public function checkIfSleepTimeExists($userId, $company, $date, $startTime)
    {
        $this->selectSleepTimeFromDatabase($company, $userId, $date, $startTime);
        $numberOfRows = $this->result->num_rows;
        if ($numberOfRows > 0) {
            $exists = true;
        } else {
            $exists = false;
        }
        return $exists;
    }


    /**
     * @param $company
     * @param $userId
     * @param $date
     * @param $startTime
     * @return string
     */
    public function selectSleepTimeFromDatabase($company, $userId, $date, $startTime)
    {
        $this->connect();

        $companyId = $this->getCompanyId($company);

        $statement = "SELECT *
                      FROM sleep_start_time
                      WHERE user_id =  '$userId'
                      AND company_id = '$companyId'
                      AND date =  '$date'
                      AND start_time = '$startTime'";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();
    }

    /**
     * function to change the email address
     * @param $userId
     * @param $newEmail
     * @return bool|mysqli_result
     */
    public function insertNewEmail($userId, $newEmail) {

        $this->connect();

        $statement = "UPDATE user SET email = '$newEmail'
                          WHERE user_id = '$userId'
                          ";

        $result = $this->executeStatement($statement);

        return $result;
    }

    public function selectAllMeasurementsFromUser($userId) {

        $this->connect();

        $statement = "SELECT user_id, m.name, m.nameInApp, u.name as unit, c.name as groupname, m.sliderLimit, company.name as favoriteCompany
                      FROM  `user_company_account`
                      JOIN company
                      ON company_id = company.id
                      JOIN company_has_measurement chm
                      ON company.id = chm.company_id
                      JOIN measurement m
                      ON chm.measurement_id = m.id
                      JOIN category c
                      ON m.group_id = c.id
                      JOIN unit u
                      ON m.unit_id = u.id
                      WHERE user_id = '$userId'
                      GROUP BY m.name
                      ";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();

    }

    public function selectDuplicateMeasurementsFromUser($userId) {

        $this->connect();

        $statement = "SELECT user_id, m.name, m.nameInApp, u.name AS unit, c.name AS groupname, m.sliderLimit
                      FROM  `user_company_account`
                      JOIN company ON company_id = company.id
                      JOIN company_has_measurement chm ON company.id = chm.company_id
                      JOIN measurement m ON chm.measurement_id = m.id
                      JOIN category c ON m.group_id = c.id
                      JOIN unit u ON m.unit_id = u.id
                      WHERE user_id =  '$userId'
                      GROUP BY m.name
                      HAVING ( COUNT(m.name) > 1 )
                      ";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();
    }
}

?>
