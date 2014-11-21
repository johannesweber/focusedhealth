<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 10:30
 */


class DatabaseConnection {

    protected $db_connection;

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
        }else{
            echo 'Connection established';
        }
    }

    public function executeStatement($statement){

        $db_result = mysqli_query( $this->db_connection, $statement );

        if ( ! $db_result )
        {
            die('Invalid Statement: '. mysqli_error($this->db_connection));
        }else{
            echo 'Statement succesfully executed';
        }
        return $db_result;
    }

    public function close(){
        mysqli_close($this->db_connection);
    }
}
?>