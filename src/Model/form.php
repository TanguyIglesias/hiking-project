<?php
session_start();
require './database.php';

$db = new Database;
$conn = $db->connectDb();

if(isset($_POST['submit']))
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

}


