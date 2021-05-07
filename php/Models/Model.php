<?php
//include the config file with te database connection
include ('config.php');


class Model {

    public static function runQuery($sql) {
        // Instantiates a new DB connnection (See config.php)
        $db = DB::getDB();
        $result = mysqli_query($db->connection, $sql);
            
        //If there is an error creating the account, then print out the error
        if($db->connection->error) {
            die($db->connection->error);
        }

        return $result;
    }

    // Use this function when you are getting an array of records (not just a single record)
    public static function _getRecords($sql) {
        $result = static::runQuery($sql);
        $records = [];

        while ($row = $result->fetch_assoc()) {
            array_push($records, $row);
        }
        return $records;
    }

    // Used for getting a single record from the database and returning 1 thing
    public static function _getRecord($sql) {
        $records = static::_getRecords($sql);
        return @$records[0];
    }
}