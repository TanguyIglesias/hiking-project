<?php

class UserInfo extends Database
{
    public function userInfo()
    {
        $db=$this->connectDb();

        $userID = 5;

        $req = $db->query("SELECT * FROM users WHERE user_id=$userID");

        return $req->fetch(PDO::FETCH_ASSOC);

    }
    
}