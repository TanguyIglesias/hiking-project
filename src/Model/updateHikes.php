<?php

/* echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

echo '<pre>';
var_dump($_POST['update_hike']);
echo '</pre>'; */


class UpdateHike extends Database
{

    public function updateHike() {
        if (!isset($_SESSION)) { session_start(); }
        $db=$this->connectDb();
        $hike_id = $_GET['hikeID'];
        $headerLoc = "Location:/updateHike?hikeID=$hike_id";

        if (isset($_POST['update_hike']))
        {

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $image_path = test_input($_POST["image_path"]);
                if (!filter_var($image_path, FILTER_VALIDATE_URL)) 
                {
                    header($headerLoc);
                    $_SESSION['urlErr'] = "Invalid url format";
                    exit();
                }
            

            $content = test_input($_POST['content']);
            

            if(empty($_POST["hike_name"]))
            {
                header($headerLoc);
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {   
                $hike_name = test_input($_POST['hike_name']);
                $req = $db->query("SELECT * FROM hikes WHERE hike_name='$hike_name' AND hike_id<>$hike_id");

                if($req->rowCount()>0)
                {
                    header($headerLoc);
                    $_SESSION['nameDupes'] = 'Ce nom existe déjà';
                    exit();

                }else
                {
                    if(!preg_match("/^[a-zA-Z-' ]*$/", $hike_name))
                    {
                        
                        header($headerLoc);
                        $_SESSION['nameErr'] = "Seul les lettres et les espaces sont autorisés.";
                        exit();                 
                    }
                }
            }

            if(empty($_POST["distance"]))
            {
                header($headerLoc);
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {
                $distance = test_input($_POST['distance']);
                if(!preg_match("/^[0-9]*$/", $distance))
                {
                    header($headerLoc);
                    $_SESSION['distanceErr'] = "Seul les chiffres sont autorisés.";
                    exit();
                }
            }

            if(empty($_POST["elevation_gain"]))
            {
                header($headerLoc);
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {
                $elevation_gain = test_input($_POST['elevation_gain']);
                if(!preg_match("/^[0-9]*$/", $elevation_gain))
                {
                    header($headerLoc);
                    $_SESSION['elevationErr'] = "Seul les chiffres sont autorisés.";
                    exit();
                }
            }
        

            if(empty($_POST["content"]))
            {
                header($headerLoc);
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {
                $content = test_input($_POST['content']);
                if(!preg_match("/^[a-zA-Z-' ]*$/", $content))
                {
                    header($headerLoc);
                    $_SESSION['contentErr'] = "Seul les lettres et les espaces sont autorisés.";
                    exit();
                }
            }

            $image_path = test_input($_POST["image_path"]);
                if (!filter_var($image_path, FILTER_VALIDATE_URL)) 
                {
                    header($headerLoc);
                    $_SESSION['urlErr'] = "Invalid url format";
                    exit();
                }
            
            //$hikeUpdateDate = date('Y-m-d');

            
            $update_date = date("d/m/Y");
            $update_explode = explode("/", $update_date);
            $hikeUpdate = "$update_explode[2]-$update_explode[1]-$update_explode[0]";
            
            $duration = $_POST['duration'];
            $hike_id = $_GET['hikeID'];

            $data = [
                'hike_name' => $hike_name,
                'content' => $content,
                'update_date' => $hikeUpdate,
                'distance' => $distance,
                'elevation' => $elevation_gain,
                'duration' => $duration,
                'image_path' => $image_path,
                
            ];
            
            $query = "UPDATE hikes SET hike_name=:hikename, content=:hikecontent, update_date=:update_date, distance=:hikedistance, elevation_gain=:hikeelevation, duration=:hikeduration, image_path=:hikeimage WHERE hike_id = $hike_id";
            
            $query_run = $db->prepare($query);
            $query_run->bindParam(':hikename', $data['hike_name']);
            $query_run->bindParam(':hikecontent', $data['content']);
            $query_run->bindParam(':update_date', $data['update_date']);
            $query_run->bindParam(':hikedistance', $data['distance']);
            $query_run->bindParam(':hikeelevation', $data['elevation']);
            $query_run->bindParam(':hikeduration', $data['duration']);
            $query_run->bindParam(':hikeimage', $data['image_path']);
            if($query_run->execute())
            {   

                require_once '../Model/Tag.php';
                
                $tag_id = $_POST['tag_id'];

                $tag = new Tag();

                $tag->deleteRelation($hike_id);

                foreach($tag_id as $value){
                    $tag->addRelation($value, $hike_id);
                }


                
                require_once '../controler/sendMailUpdate.php';
                header("Location:/hike?hikeID=$hike_id");
            } else
            {
                echo'ERROR';
            }
        }
    }
}

$update = new UpdateHike();
$update->updateHike();