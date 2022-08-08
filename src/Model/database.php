<?php


class Database {

    function connectDb($file='core/setting.ini')
    {

        $log= parse_ini_file($file,TRUE);

        try {
            $conn = new PDO('mysql:host=' . $log['log']['SERVER_NAME'] . ';dbname='. $log['log']['dbname'] ,$log['log']['USERNAME'], $log['log']['PASSWORD']);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
            // echo "Connected successfully";
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        } 
    }
}