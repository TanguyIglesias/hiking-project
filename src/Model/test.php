<?php

require '../Model/database.php';

class HikeManager extends Database
{
    // private $name;

    // public function __construct(string $name)
    // {
    //     $this->name = $name;
    // }

    public function getHikes()
    {
        $db=$this->connectDb();

        $req = $db->query('SELECT firstname, lastname FROM users');

        

        return $req->fetchAll(PDO::FETCH_ASSOC);

        
    }


}