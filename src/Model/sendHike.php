<?php
require_once '../Model/Tag.php';

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
                $data = ucfirst($data);
                return $data;
            }


            $image_path = test_input($_POST["image_path"]);
                if (!filter_var($image_path, FILTER_VALIDATE_URL)) 
                {
                    header("Location:/createhike");
                    $_SESSION['urlErr'] = "Invalid url format";
                    exit();
                }
            }

            $content = $_POST['content'];
                $content = test_input($content);
            

            if(empty($_POST["hike_name"]))
            {
                header("Location:/createhike");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {   
                $hike_name = test_input($_POST['hike_name']);
                $req = $db->query("SELECT * FROM hikes WHERE hike_name='$hike_name'");
                if($req->rowCount()>0)
                {
                    header("Location:/createhike");
                    $_SESSION['nameDupes'] = 'Ce nom existe déjà';
                    exit();

                }else
                {
                    if(!preg_match("/^[a-zA-Z-' ]*$/", $hike_name))
                    {
                        
                        header("Location:/createhike");
                         $_SESSION['nameErr'] = "Seul les lettres et les espaces sont autorisés.";
                        exit();                 
                    }
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
                    $_SESSION['distanceErr'] = "Seul les chiffres sont autorisés.";
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
                    $_SESSION['elevationErr'] = "Seul les chiffres sont autorisés.";
                    exit();
                }
            }
        

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

            $image_path = test_input($_POST["image_path"]);
                if (!filter_var($image_path, FILTER_VALIDATE_URL)) 
                {
                    header("Location:/createhike");
                    $_SESSION['urlErr'] = "Invalid url format";
                    exit();
                }

            $_POST["creation_date"] = date("d/m/Y");
            $creation_date = $_POST["creation_date"];
            $date_explode = explode("/", $creation_date);
            $date = "$date_explode[2]-$date_explode[1]-$date_explode[0]";
            
            $_POST['update_date'] = date("d/m/Y");
            $update_date = $_POST["update_date"];
            $update_explode = explode("/", $update_date);
            $update = "$update_explode[2]-$update_explode[1]-$update_explode[0]";

            $duration = $_POST['duration'];
            $userId = $_SESSION['user_id'];        
        
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
            $query_run->execute();
            
            $tag_id = $_POST['tag_id'];
            
            $tag = new Tag();
            var_dump($tag_id);
            foreach($tag_id as $value){
                $tag->addTag($value, $hike_name);
            }
        } 
    }



$send = new SendHike();
$send->sendHike();