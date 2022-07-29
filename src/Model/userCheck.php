<?php
if (!isset($_SESSION)) { session_start(); }

class UserCheck extends Database
{
    public function userCheck()
    {
        //session_start();

        $db=$this->connectDb();

        $nickname = $_POST['nickname'];
        $password = $_POST['password'];

        $req = $db->query("SELECT * FROM users WHERE nickname='$nickname'");

        $data = $req->fetch(PDO::FETCH_ASSOC);

        $firstname = $data['firstname'];

/*         if($data['password'] === $password) {
            echo "Welcome $firstname";
            return $data;
        }
        else {
            echo "Wrong PassWord";
        } */
        
        if(password_verify($password, $data['password'])) {
            echo "Welcome $firstname";
            return $data;
        }
        else {
            echo "Wrong PassWord";
        }
    }
    
}
