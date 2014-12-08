<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 10:30
 */


class DatabaseConnection {

    protected $db_connection;
    protected $result;
    protected $resultarray = [];

    public function __construct(){

        define ("MYSQL_HOST", "localhost");
        define ("MYSQL_USER", "5ive");
        define ("MYSQL_PASSWORD", "team5ivemysql");
        define ("MYSQL_DATABASE", "healthhub" );

    }

    public function connect(){

        $this->db_connection = mysqli_connect (MYSQL_HOST,
            MYSQL_USER,
            MYSQL_PASSWORD,
            MYSQL_DATABASE
        );

        if ( ! $this->db_connection ){
            echo 'Connection failed';
        }
    }

    public function executeStatement($statement){

        $db_result = mysqli_query( $this->db_connection, $statement );

        if ( ! $db_result )
        {
            die('Invalid Statement: '. mysqli_error($this->db_connection));
        }

        $this->result = $db_result;

        return $db_result;
    }

    public function close(){
        mysqli_close($this->db_connection);
    }

    public function getResultAsArray(){

<<<<<<< HEAD
      /*  while ($zeile = mysqli_fetch_array( $this->result, MYSQL_ASSOC)){

            array_push($this->resultarray, $zeile);
        }

        return json_encode($this->resultarray);

=======
>>>>>>> FETCH_HEAD
        $resultArray = mysqli_fetch_array( $this->result, MYSQL_ASSOC);
        return $resultArray;
*/


        $resultArray = mysqli_fetch_array( $this->result, MYSQL_ASSOC);
        return $resultArray;

    }

    public function getResultAsJSON(){

<<<<<<< HEAD
     /*   $result = array();

        foreach($this->resultarray  as ) */




=======
        while ($zeile = mysqli_fetch_array( $this->result, MYSQL_ASSOC)){
>>>>>>> FETCH_HEAD

        while ($zeile = mysqli_fetch_array( $this->result, MYSQL_ASSOC)){
            array_push($this->resultarray, $zeile);
        }
<<<<<<< HEAD
=======

>>>>>>> FETCH_HEAD
        return json_decode(json_encode($this->resultarray));



    }
}

?>