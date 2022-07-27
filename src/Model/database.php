<?php

class Database {
    
    function connectDb()
    {

        $servername = "188.166.24.55";
        $username = "mvc";
        $password = "Yd370VDnM1t5y19Q";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=jepsen6-mvc", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
            // echo "Connected successfully";
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        } 
    }
}

