<?php

/* require '../Model/database.php'; */

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

        $req = $db->query('SELECT * FROM hikes');

        

        return $req->fetchAll(PDO::FETCH_ASSOC);

        
    }
    
}

class UserManager extends Database {

    public function getUsers()
    {
        $db=$this->connectDb();

        $req = $db->query('SELECT * FROM users');

        

        return $req->fetchAll(PDO::FETCH_ASSOC);

    }
}

class TagManager extends Database {

    public function getTags()
    {
        $db=$this->connectDb();

        $req = $db->query('SELECT * FROM tags');

        

        return $req->fetchAll(PDO::FETCH_ASSOC);

    }
}

