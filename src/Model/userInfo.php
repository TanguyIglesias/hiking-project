<?php
if (!isset($_SESSION)) { session_start(); }
class UserInfo extends Database
{
    public function userInfo()
    {
        $db=$this->connectDb();

        $nickname = $_SESSION['nickname'];

        $req = $db->query("SELECT * FROM users WHERE nickname='$nickname'");

        return $req->fetch(PDO::FETCH_ASSOC);

    }

    public function userInfoByID($userID)
    {
        $db=$this->connectDb();

        $req = $db->query("SELECT firstname, lastname FROM users WHERE user_id='$userID'");

        return $req->fetch(PDO::FETCH_ASSOC);

    }
    
}