<?php

/* require '../Model/database.php'; */

class SendForm extends Database
{

    public function sendForm() {

/*      $db = new Database;
        $conn = $db->connectDb(); */

        $db=$this->connectDb();

/*         $firstname = "John";
        $lastname = "Doe";
        $nickname = "Johny";
        $mail = "johnyBoy@gmail.com";
        $password = "123456789";
        $city = "London";
        $country = "UK";
 */
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $nickname = $_POST['nickname'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'nickname' => $nickname,
            'mail' => $mail,
            'password' => $password,
            'city' => $city,
            'country' => $country,
        ];

        $query = "INSERT INTO users (firstname, lastname, nickname, mail, password, city, country) VALUES (:firstname, :lastname, :nickname, :mail, :password, :city, :country)";
        $query_run = $db->prepare($query);

        $query_run->execute($data);

/*      $sql = "INSERT INTO users (firstname, lastname, nickname, mail, password, city, country) VALUES  (`John`,`Doe`,`Johny`, `johnyBoy@gmail.com`, `123456789`,`London`, `UK`)";
        $query_run = $conn->prepare($sql)->execute([$firstname, $lastname, $nickname, $mail, $password, $city, $country]); */

        /* if (isset($_POST['submit']))
        {
        
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $nickname = $_POST['nickname'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $city = $_POST['city'];
            $country = $_POST['country'];
        
        
            $query = "INSERT INTO users (firstname, lastname, nickname, mail, password, city, country) VALUES (:firstname, :lastname, :nickname, :mail, :password, :city, :country)";
            $query_run = $conn->prepare($query);
        
            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'nickname' => $nickname,
                'mail' => $mail,
                'password' => $password,
                'city' => $city,
                'country' => $country,
            ];
        
            $query_execute = $query_run->execute($data);
        
        } */
    }
}