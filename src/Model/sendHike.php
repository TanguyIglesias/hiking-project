<?php

class SendHike extends Database
{

    public function sendHike() {
        if (!isset($_SESSION)) { session_start(); }


        $db=$this->connectDb();

        if (isset($_POST['submit']))
        {   

            $hike_name = $distance = $elevation_gain = $duration = $creation_date = $update_date = $image_path = "";
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }
        
            $hike_name = $_POST['hike_name'];
            $distance = $_POST['distance'];
            $elevation_gain = $_POST['elevation_gain'];
            $duration = $_POST['duration'];
            $creation_date = $_POST['creation_date'];
            $update_date = $_POST['update_date'];


            $image_path = test_input($_POST["image_path"]);
                  if (!filter_var($image_path, FILTER_VALIDATE_URL)) 
                  {
                      header("Location:/createhike");
                      $_SESSION['urlErr'] = "Invalid url format";
                      exit();
                  }


            $content = $_POST['content'];
            $userId = 3;        
        
            $query = "INSERT INTO hikes (user_id, hike_name, content, creation_date, update_date, distance, elevation_gain, duration, image_path) VALUES (:user_id, :hike_name, :content, :creation_date, :update_date, :distance, :elevation_gain, :duration, :image_path)";
            $query_run = $db->prepare($query);
        
            $data = [
                'hike_name' => $hike_name,
                'distance' => $distance,
                'elevation_gain' => $elevation_gain,
                'duration' => $duration,
                'creation_date' => $creation_date,
                'update_date' => $update_date,
                'image_path' => $image_path,
                'content' => $content,
                'user_id' => $userId,
            ];
            $query_run->bindParam(':hike_name',$data['hike_name']);
            $query_run->bindParam(':distance',$data['distance']);
            $query_run->bindParam(':elevation_gain',$data['elevation_gain']);
            $query_run->bindParam(':duration',$data['duration']);
            $query_run->bindParam(':creation_date',$data['creation_date']);
            $query_run->bindParam(':update_date',$data['update_date']);
            $query_run->bindParam(':image_path',$data['image_path']);
            $query_run->bindParam(':content',$data['content']);
            $query_run->bindParam(':user_id',$data['user_id']);
            
            if ($query_run->execute())
            {
                header("Location:/");
            }else{
                echo'ERROR';
            }
        } 
    }
}

$send = new SendHike();
$send->sendHike();