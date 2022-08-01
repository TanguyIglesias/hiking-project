<?php

class SendHike extends Database
{

    public function sendHike() {
        if (!isset($_SESSION)) { session_start(); }


        $db=$this->connectDb();

        if (isset($_POST['submit']))
        {
            $hike_name = $distance = $elevation_gain = $duration = $creation_date = $update_date = $content = "";
            
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
                // $data = ucfirst($data);
                return $data;
            }

            if(empty($_POST["hike_name"]))
            {
                header("Location:/createHike");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {
                $hike_name = test_input($_POST['hike_name']);
                if(!preg_match("/^[a-zA-Z-' ]*$/", $hike_name))
                {
                    header("Location:/createhike");
                    $_SESSION['nameErr'] = "Seul les lettres et les espaces sont autorisés.";
                    exit();
                }
            }

            if(empty($_POST["distance"]))
            {
                header("Location:/createhike");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {
                $distance = test_input($_POST['distance']);
                if(!preg_match("/^[0-9]*$/", $distance))
                {
                    header("Location:/createhike");
                    $_SESSION['distanceErr'] = "Seul les chiffres et les : sont autorisés.";
                    exit();
                }
            }

            if(empty($_POST["elevation_gain"]))
            {
                header("Location:/createhike");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {
                $elevation_gain = test_input($_POST['elevation_gain']);
                if(!preg_match("/^[0-9]*$/", $elevation_gain))
                {
                    header("Location:/createhike");
                    $_SESSION['elevationErr'] = "Seul les chiffres et les : sont autorisés.";
                    exit();
                }
            }

            // if(empty($_POST["duration"]))
            // {
            //     header("Location:/createhike");
            //     $_SESSION['error'] = 'Formulaire Incomplet';
            //     exit();
            // }else
            // {
            //     $duration = test_input($_POST['duration']);
            //     if(!preg_match("/^[0-9]*$/", $duration))
            //     {
            //         header("Location:/createhike");
            //         $_SESSION['durationErr'] = "Seul les chiffres et les : sont autorisés.";
            //         exit();
            //     }
            // }

            if(empty($_POST["content"]))
            {
                header("Location:/createhike");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {
                $content = test_input($_POST['content']);
                if(!preg_match("/^[a-zA-Z-' ]*$/", $content))
                {
                    header("Location:/createhike");
                    $_SESSION['contentErr'] = "Seul les lettres et les espaces sont autorisés.";
                    exit();
                }
            }

            $_POST["creation_date"] = date("d/m/Y");
            $creation_date = $_POST["creation_date"];
            $date_explode = explode("/", $creation_date);
            $date = "$date_explode[2]-$date_explode[1]-$date_explode[0]";
            
            $_POST['update_date'] = date("d/m/Y");
            $update_date = $_POST["update_date"];
            $update_explode = explode("/", $update_date);
            $update = "$update_explode[2]-$update_explode[1]-$update_explode[0]";

            // $hike_name = $_POST['hike_name'];
            // $distance = $_POST['distance'];
            // $elevation_gain = $_POST['elevation_gain'];
            $duration = $_POST['duration'];
            //$creation_date = $_POST['creation_date'];
            //$update_date = $_POST['update_date'];
            $image_path = "rekphqpsjw";
            //$content = $_POST['content'];
            $userId = 3;        
        
            $query = "INSERT INTO hikes (user_id, hike_name, content, creation_date, update_date, distance, elevation_gain, duration, image_path) VALUES (:user_id, :hike_name, :content, :creation_date, :update_date, :distance, :elevation_gain, :duration, :image_path)";
            $query_run = $db->prepare($query);
        
            $data = [
                'hike_name' => $hike_name,
                'distance' => $distance,
                'elevation_gain' => $elevation_gain,
                'duration' => $duration,
                'creation_date' => $date,
                'update_date' => $update,
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