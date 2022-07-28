<?php

/* require '../Model/database.php'; */

class UpdateForm extends Database
{

    public function updateForm() {

        $db=$this->connectDb();


        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $nickname = $_POST['nickname'];
        //$nickname = "Joe";
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $userID = 5;

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'nickname' => $nickname,
            'mail' => $mail,
            'password' => $password,
            'city' => $city,
            'country' => $country
        ];

        //$query = "UPDATE users SET firstname= :firstname, lastname= :lastname, nickname= :nickname, mail= :mail, password= :password, city= :city, country= :country WHERE user_id=5";
        $query = "UPDATE users SET nickname= :nickname WHERE user_id = 5";
        $query_run = $db->prepare($query);

        $query_run->execute($data);

    }
}