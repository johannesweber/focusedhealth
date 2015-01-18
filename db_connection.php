<?php

/**
 *
 * The class is needed to establish the database connection.
 * The class contains various methods that can be called again in other classes.
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 10:30
 */
class DatabaseConnection
{

    protected $db_connection;
    protected $result;

    /**
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

        mysqli_set_charset($this->db_connection, "utf-8");
    }

    /**
     * function to execute SQL statement
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
     * function to get a result as Array
     * @return array|null
     */
    public function getResultAsArray()
    {

        $resultArray = mysqli_fetch_array($this->result, MYSQL_ASSOC);
        return $resultArray;
    }

    /**
     * function to check if the result true or false
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * function to get a result as JSON Object
     * @return string
     */
    public function getResultAsJSON()
    {
        $data = array();

        for ($x = 0; $x < mysqli_num_rows($this->result); $x++) {

            /**
             * Function to convert one specific element into utf 8
             * it takes to much time to iterate through all elements ant convert them :)
             * $element['nameInGerman'] = mb_convert_encoding($element['nameInGerman'], 'utf-8');
             */

            $element = mysqli_fetch_assoc($this->result);

            $data[] = $element;
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
     * function to get the Id for the period.
     * @param $period
     * @return mixed Id of the right period
     */
    public function getPeriodId($period)
    {
        $this->connect();

        $fetch = "SELECT period_number
              FROM period
              WHERE name = '$period'
              ";

        $this->executeStatement($fetch);
        $result = $this->getResultAsArray();
        $periodId = $result['period_number'];
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
     *
     * function to select the goal values from the database
     * @param $measurement
     * @param $userId
     * @param $period
     * @param $limit
     * @return string
     */
    public function selectGoalFromDatabase($measurement, $userId, $company, $period, $startDate)
    {
        $this->connect();

        $measurementId = $this->getMeasurementId($measurement);
        $companyId = $this->getCompanyId($company);
        $periodId = $this->getPeriodId($period);

        $endDate = $this->getEnddateDependingOnPeriod($startDate, $period);

        $statement = "SELECT subsum.currentValue, subsum.measurement, subsum.unit, goal.goal_value as goalValue
                  FROM goal
                  JOIN
                  (SELECT value.user_id, SUM(value.value) as currentValue, unit.name as unit, meas.name as measurement
                   FROM value
                   JOIN measurement meas
                   ON meas.id = value.measurement_id
                   JOIN unit
                   ON meas.unit_id = unit.id
                   WHERE measurement_id = $measurementId
                   AND user_id = $userId
                   AND company_id = $companyId
                   AND date BETWEEN '$startDate' AND '$endDate'
                  ) subsum
                  ON (goal.user_id = subsum.user_id)
                  WHERE goal.measurement_id = $measurementId
                  AND goal.company_id = $companyId
                  AND goal.period = $periodId
                      ";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();
    }


    /**
     * function to select the activities from our database
     * @param $company
     * @param $userId
     * @param $limit
     * @return string
     */
    public function selectActivityFromDatabase($company, $userId, $date, $limit)
    {
        $this->connect();

        // method call to get the right Id of the company
        $companyId = $this->getCompanyId($company);

        $statement = "SELECT activity, date, start_time, ROUND(duration/60000) AS DurationInMin, distance, calories, description
                      FROM activity
                      WHERE user_id ='$userId'
                      AND company_id = '$companyId'
                      AND date <='$date'
                      ORDER BY DATE DESC
                      LIMIT $limit
                      ";
        $this->executeStatement($statement);

        return $this->getResultAsJSON();
    }


    /**
     * function to select all values from food of our database
     * @param $company
     * @param $userId
     * @param $date
     * @param $limit
     * @return string
     */
    public function selectFoodFromDatabase($company, $userId, $date, $limit)
    {
        $this->connect();


        $companyId = $this->getCompanyId($company);

        $statement = "SELECT date, amount, name, unit, calories, carbs, fat, fiber, protein, sodium
                      FROM food
                      WHERE user_id='$userId'
                      AND company_id = '$companyId'
                      AND date <= '$date'
                      ORDER BY DATE DESC
                      LIMIT $limit
                      ";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();
    }


    /**
     * function to select values from our database
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

        // If the limit less than a year use the first statement
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
        } // is used if the limit is more than a year and the months will be summarized
        else {

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
     * @param date
     * @param $userId
     * @param $company
     * @return bool true if desired goal is stored in database
     */
    public function checkIfGoalExists($measurement, $userId, $company, $period, $startdate) //achtung perioid hinzugefügt
    {
        $measurementId = $this->getMeasurementId($measurement);
        $companyId = $this->getCompanyId($company);
        $periodId = $this->getPeriodId($period);

        $statement = "SELECT * FROM goal
                      WHERE user_id = '$userId'
                      AND measurement_id = '$measurementId'
                      AND company_id = '$companyId'
                      AND period = '$periodId'
                      ";

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
     * function to ckeck if the data and the tokens are available
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
        $this->checkIfValueAlreadyExists($company, $measurement, $userId, $date);

        $numberOfRows = $this->result->num_rows;

        // check if the SQL result wether empty or a value is available
        if ($numberOfRows > 0) {
            $exists = true;
        } else {

            $exists = false;
        }
        return $exists;
    }


    /**
     * function to ckeck if value already exists in our database
     * @param $company
     * @param $measurement
     * @param $userId
     * @param $date
     * @return string
     */
    public function checkIfValueAlreadyExists($company, $measurement, $userId, $date)
    {
        $this->connect();

        $measurementId = $this->getMeasurementId($measurement);
        $companyId = $this->getCompanyId($company);

        $statement = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$measurementId' AND company_id='$companyId' AND date= '$date'";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();

    }

    /**
     * function to insert/update values in our database
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

        // update value if value already exists
        if ($valuesExists) {

            $statement = "UPDATE value SET value = '$value'
                          WHERE user_id = '$userId'
                          AND company_id = '$companyId'
                          AND measurement_id = '$measurementId'
                          AND date = '$date'
                          ";
        } // insert value if it doesn't exist
        else {

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
     * function to insert activities in our database
     * @param $userId
     * @param $company
     * @param $calories
     * @param $distance
     * @param $description
     * @param $duration
     * @param $lastModified
     * @param $name
     * @param $startDate
     * @param $startTime
     * @return bool
     */
    public function insertActivity($userId, $company, $calories, $distance, $description, $duration, $lastModified, $name, $startDate, $startTime)
    {
        $this->connect();

        // set false for checking if  the insert statement is successfull
        $successfull = false;

        $companyId = $this->getCompanyId($company);

        $valuesExists = $this->checkIfActivityExists($userId, $company, $name, $startDate, $startTime);

        $result = "";
        if (!$valuesExists) {

            $statement = "INSERT INTO activity (user_id, company_id, activity, date, start_time, duration, distance, calories, description, last_modified)
                          VALUES ('$userId', '$companyId', '$name', '$startDate', '$startTime', '$duration', '$distance', '$calories', '$description', '$lastModified')";

            $result = $this->executeStatement($statement);

        } else {
            $successfull = true;
        }

        // if the insert statement is succesfully set variable true and return
        if ($result) {
            $successfull = true;
        }
        return $successfull;
    }

    /**
     * function to ckeck if activity already exists in our database
     * @param $userId
     * @param $company
     * @param $name
     * @param $startDate
     * @param $startTime
     * @return bool
     */
    public function checkIfActivityExists($userId, $company, $name, $startDate, $startTime)
    {
        $this->connect();

        $companyId = $this->getCompanyId($company);

        $statement = "SELECT * FROM activity WHERE user_id='$userId' AND activity='$name' AND company_id='$companyId' AND date= '$startDate' AND start_time= '$startTime' ";

        $this->executeStatement($statement);

        $numberOfRows = $this->result->num_rows;

        if ($numberOfRows > 0) {

            $exists = true;
        } else {

            $exists = false;
        }
        return $exists;
    }


    /**
     * function to insert food into database
     * @param $userId
     * @param $company
     * @param $date
     * @param $amount
     * @param $brand
     * @param $name
     * @param $unit
     * @param $calories
     * @param $carbs
     * @param $fat
     * @param $fiber
     * @param $protein
     * @param $sodium
     * @return bool
     */
    public function insertFood($userId, $company, $date, $amount, $brand, $name, $unit, $calories, $carbs, $fat, $fiber, $protein, $sodium)
    {
        $this->connect();

        $successfull = false;

        $companyId = $this->getCompanyId($company);

        $valuesExists = $this->checkIfFoodExists($userId, $company, $date, $name);

        $result = "";
        if (!$valuesExists) {


            $statement = "INSERT INTO food (user_id, company_id, date, amount, brand, name, unit, calories, carbs, fat, fiber, protein, sodium)
                VALUES ('$userId', '$companyId', '$date', '$amount', '$brand', '$name', '$unit', '$calories', '$carbs', '$fat', '$fiber', '$protein', '$sodium')";

            $result = $this->executeStatement($statement);

        } else {
            $successfull = true;
        }

        if ($result) {
            $successfull = true;

        }
        return $successfull;
    }


    /**
     * function to ckeck if food already exists in our database
     * @param $userId
     * @param $company
     * @param $date
     * @param $name
     * @return bool
     */
    public function checkIfFoodExists($userId, $company, $date, $name)
    {

        $this->connect();

        $companyId = $this->getCompanyId($company);


        $statement = "SELECT * FROM food WHERE user_id='$userId'  AND company_id='$companyId' AND date= '$date' AND name = '$name' ";

        $this->executeStatement($statement);


        $numberOfRows = $this->result->num_rows;

        if ($numberOfRows > 0) {

            $exists = true;
        } else {

            $exists = false;
        }
        return $exists;
    }


    /**
     * function to insert a  goal
     * @param $userId
     * @param $company
     * @param $measurement
     * @param $value
     * @param $period
     * @param startDate as String
     * @return bool
     */
    public function insertGoal($userId, $company, $measurement, $goalValue, $period, $startDateAsString)
    {
        $this->connect();

        $successfull = false;

        //converts date from string to MySQL Date
        $timestamp = strtotime($startDateAsString);
        $startDate = date("Y-m-d", $timestamp);
        $measurementId = $this->getMeasurementId($measurement);
        $companyId = $this->getCompanyId($company);
        $periodId = $this->getPeriodId($period);

        $valuesExists = $this->checkIfGoalExists($measurement, $userId, $company, $period, $startDate);

        if ($valuesExists) {

            //enddate is always NULL but we left it in our database so we could use it later. The same with start_value
            $statement = "UPDATE goal
                          set goal_value='$goalValue', start_value = 0, startdate= '$startDate', enddate=NULL, period='$periodId',user_id='$userId', measurement_id='$measurementId', company_id='$companyId'
                          WHERE user_id='$userId'
                          AND measurement_id='$measurementId'
                          AND company_id='$companyId' AND period='$periodId'";
        } else {

            $statement = "INSERT INTO goal (goal_value, start_value, startdate, enddate, period, user_id, measurement_id, company_id)
                          VALUES ('$goalValue', 0, '$startDate', Null, '$periodId', '$userId', '$measurementId', '$companyId')";
        }
        $result = $this->executeStatement($statement);

        if ($result) {

            $successfull = true;
        }
        return $successfull;
    }


    /**
     * function to insert the information of sleep in the database
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
     * get the sleep start time for spezific date, time and user
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
    public function insertNewEmail($userId, $newEmail)
    {
        $this->connect();

        $statement = "UPDATE user SET email = '$newEmail'
                          WHERE user_id = '$userId'
                          ";

        $result = $this->executeStatement($statement);

        return $result;
    }

    /**
     * function to get all the measures which a user has
     * it is possible that someone has different measures because he is using  wearables from other companies (Withings or Fitbit ..)
     * @param $userId
     * @return string
     */
    public function selectAllMeasurementsFromUser($userId)
    {
        $this->connect();

        $statement = "SELECT m.name, m.nameInApp, u.name as unit, c.name as groupname, m.sliderLimit, m.goalable as isGoalable, company.name as favoriteCompany
                      FROM  user_company_account
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
                      WHERE company.name IN
						(SELECT company.name
                      FROM user_company_account
                      JOIN company
                      ON company_id = company.id
                      WHERE user_id = '$userId')
                      GROUP BY m.name
                      ";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();

    }

    /**
     * function to check if the companies have the same measurements for a specific user.
     *
     * @param $userId
     * @return string duplicate measurements
     */
    public function selectDuplicateMeasurementsFromUser($userId)
    {
        $this->connect();

        $statement = "SELECT m.name, m.nameInApp, u.name AS unit, c.name AS groupname, m.sliderLimit
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

    /**
     * function to delete an account (Withings, Fitbit etc) of an user
     * @param $userId
     * @param $companyName
     * @return mixed
     */
    public function deleteCompanyFromUser($userId, $companyName)
    {
        $this->connect();

        $companyId = $this->getCompanyId($companyName);

        $statement = "DELETE FROM user_company_account
                      WHERE user_id = '$userId'
                      AND company_id = '$companyId'
                      ";

        $this->executeStatement($statement);

        return $this->result;
    }

    /**
     * function to insert a new company (Withings, Fitbit etc) of an user
     * @param $userId
     * @param $companyName
     * @return mixed
     */
    public function insertCompanyFromUser($userId, $companyName)
    {
        $this->connect();

        $companyId = $this->getCompanyId($companyName);
        $timestamp = time();
        $date = date("Y-m-d", $timestamp);

        $statement = "INSERT INTO user_company_account (user_id, company_id, company_account_id, timestamp)
                      VALUES ('$userId', '$companyId', '$userId', '$date')
                      ";

        $this->executeStatement($statement);

        return $this->result;
    }

    /**
     * function to get all categories from the database
     * @return string
     */
    public function selectCategoryFromDatabase()
    {

        $this->connect();

        $statement = "SELECT name
                      FROM category
                      ";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();
    }

    /**
     * function to get the companies of an user
     * @param $userId
     * @return string
     */
    public function selectCompaniesFromUser($userId)
    {

        $this->connect();

        $statement = "SELECT c.name , c.nameInApp
                      FROM user_company_account uca
                      JOIN company c
                      ON uca.company_id = c.id
                      WHERE user_id = '$userId'
                      ";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();
    }

    /**
     *function to get all companies (and how often) in our table user_company_account
     * @return string
     */
    public function selectAllCompanies()
    {

        $this->connect();

        $statement = "SELECT c.name , c.nameInApp
                      FROM user_company_account uca
                      JOIN company c
                      ON uca.company_id = c.id
                      ";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();
    }

    /**
     * function to check synchronization if it successfully
     * @param $result
     */
    public function showSynchronizeMessage($company, $result)
    {
        if (!$result) {
            echo '{"success" : "-1", "message" : "' . $company . ' could not be synchronized. Please try again later!"}';
        } else {
            echo '{"success" : "1", "message" : "' . $company . ' successfully synchronized!"}';
        }
    }

    public function showMessage()
    {
        if (!$this->result) {
            echo '{"success" : "-1", "message" : "Action not successfully executed.!"}';
        } else {
            echo '{"success" : "1", "message" : "Action successfully synchronized!"}';
        }
    }

    /**
     * function to check if authorization is succesfull
     * @param $company
     * @param $result
     */
    public function showAuthorizeMessage($company, $result)
    {
        if ($result) {
            echo '{"success" : "1", "message" : "You have been successfully authorized for " ' . $company . ' "!"}';
        } else {
            echo '{"success" : "-1", "message" : "Authorization for " ' . $company . ' " Failed! Please try again later!"}';
        }

    }

    /**
     * function to get all the measurement which a company is recording
     * @return string
     */
    public function selectCompanyHasMeasurement($userId)
    {

        $this->connect();

        $statement = "SELECT c.name as company, m.name as measurement
                      FROM company_has_measurement chm
                      JOIN company c
                      ON chm.company_id = c.id
                      JOIN measurement m
                      ON chm.measurement_id = m.id
                      WHERE c.name in
                      (SELECT company.name
                      FROM user_company_account
                      JOIN company
                      ON company_id = company.id
                      WHERE user_id = '$userId')
                      ";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();

    }


    /**
     * this function deletes a user from our database
     * @param $userId
     * @return string
     */
    public function deleteUser($email)
    {

        $this->connect();

        $statement = "DELETE FROM user
                      WHERE email = '$email'";

        $this->executeStatement($statement);

        return $this->getResultAsJSON();


    }

    /**
     * function to choose the period of time
     * @param $startDate
     * @param $period
     * @return bool|string returns the determined enddate as string
     */
    public function getEnddateDependingOnPeriod($startDate, $period)
    {

        //DateTime object created from param startDate to determine the enddate
        $endDateTime = date_create_from_format("Y-m-d", $startDate);

        //enddate of the goal will be calculated depending on the given period
        switch ($period) {

            case "weekly"   :
                date_add($endDateTime, date_interval_create_from_date_string('7 days'));
                break;
            case "monthly"  :
                date_add($endDateTime, date_interval_create_from_date_string('30 days'));
                break;
            case "annual"   :
                date_add($endDateTime, date_interval_create_from_date_string('365 days'));
                break;
        }

        return date_format($endDateTime, 'Y-m-d');

    }
}

?>
