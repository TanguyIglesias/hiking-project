<?php


class SendForm extends Database
{

    public function sendForm() {



        $db=$this->connectDb();

        if (isset($_POST['submit']))
        {
        
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $nickname = $_POST['nickname'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $city = $_POST['city'];
            $country = $_POST['country'];
        
        
            $query = "INSERT INTO users (firstname, lastname, nickname, mail, password, city, country) VALUES (:firstname, :lastname, :nickname, :mail, :password, :city, :country)";
            $query_run = $db->prepare($query);
        
            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'nickname' => $nickname,
                'mail' => $mail,
                'password' => $password,
                'city' => $city,
                'country' => $country,
            ];
            $query_run->bindParam(':firstname',$data['firstname']);
            $query_run->bindParam(':lastname',$data['lastname']);
            $query_run->bindParam(':nickname',$data['nickname']);
            $query_run->bindParam(':mail',$data['mail']);
            $query_run->bindParam(':password',$data['password']);
            $query_run->bindParam(':city',$data['city']);
            $query_run->bindParam(':country',$data['country']);
            if ($query_run->execute($data))
            {
                header("Location:/");
            };
        
        } 
    }
}

$send = new SendForm();
$send->sendform();