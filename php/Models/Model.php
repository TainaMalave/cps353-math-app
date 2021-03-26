<?php
include ('config.php');


class Model {

    public static function runQuery($sql) {
        $db = DB::getDB();
        $result = mysqli_query($db->connection, $sql);
            
        //If there is an error creating the account, then print out the error
        if($db->connection->error) {
            die($db->connection->error);
        }

        return $result;
    }

    public static function _getRecords($sql) {
        $result = static::runQuery($sql);
        $records = [];

        while ($row = $result->fetch_assoc()) {
            array_push($records, $row);
        }
        return $records;
    }

    public static function _getRecord($sql) {
        $records = static::_getRecords($sql);
        return @$records[0];
    }
}