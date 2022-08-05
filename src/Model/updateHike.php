<?php

echo '<pre>';
var_dump($_SESSION["hikeID"]);
echo '</pre>';

class UpdateHike extends Database
{

    public function updateHike() {
        if (!isset($_SESSION)) { session_start(); }
        $db=$this->connectDb();

        if (isset($_POST['submit']))
        {

            $hikeName = $hikeContent = $hikeDistance = $hikeElevation = $hikeDuration = $hikeImage = "";

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if(empty($_POST['hikename']))
            {
                header("Location:/updateHike");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {
                $hikeName = test_input($_POST['hikename']);
                if(!preg_match("/^[a-zA-Z-' ]*$/", $hikeName))
                {
                    header("Location:/updateHike");
                    $_SESSION['nameErr'] = "Seul les lettres et les espaces sont autorisés.";
                    exit();
                }
            }

            if(empty($_POST['hikecontent']))
            {
                header("Location:/updateHike");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();                
            }else
            {
                $hikeContent = test_input($_POST['hikecontent']);
                if(!preg_match("/^[a-zA-Z-' ]*$/", $hikeContent))
                {
                    header("Location:/updateHike");
                    $_SESSION['nameErr'] = "Seul les lettres et les espaces sont autorisés.";
                    exit();
                }
            }

            if(empty($_POST['hikedistance']))
            {
                header("Location:/updateHike");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {
                $hikeDistance = test_input($_POST['hikedistance']);
                if(!preg_match("/^[0-9]*$/", $hikeDistance))
                {
                    header("Location:/updateHike");
                    $_SESSION['nameErr'] = "Seul les chiffres sont autorisés.";
                    exit();
                }
            }

            if(empty($_POST['hikeelevation']))
            {
                header("Location:/updateHike");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else 
            {
                $hikeElevation = test_input($_POST['hikeelevation']);
                if(!preg_match("/^[0-9]*$/", $hikeElevation))
                {
                    header("Location:/updateHike");
                    $_SESSION['nameErr'] = "Seul les chiffres sont autorisés.";
                    exit();
                }
            }
            if(empty($_POST['hikeduration']))
            {
                header("Location:/updateHike");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else 
            {
                $hikeDuration = test_input($_POST['hikeduration']);
                if(!preg_match("/^[0-9]*$/", $hikeDuration))
                {
                    header("Location:/updateHike");
                    $_SESSION['nameErr'] = "Seul les chiffres sont autorisés.";
                    exit();
                }
            }

            if(empty($_POST['hikeimage']))
            {
                header("Location:/updateHike");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else 
            {
                $hikeImage = test_input($_POST['hikeimage']);
                if (!filter_var($hikeImage, FILTER_VALIDATE_URL)) 
                {
                    header("Location:/createhike");
                    $_SESSION['urlErr'] = "Invalid url format";
                    exit();
                }
            }
            
            //$hikeUpdateDate = date('Y-m-d');

            $_POST['update_date'] = date("d/m/Y");
            $update_date = $_POST["update_date"];
            $update_explode = explode("/", $update_date);
            $update = "$update_explode[2]-$update_explode[1]-$update_explode[0]";

            $hikeID = $_SESSION['hikeID'];

            $data = [
                'hike_name' => $hikeName,
                'content' => $hikeContent,
                'distance' => $hikeDistance,
                'elevation' => $hikeElevation,
                'duration' => $hikeDuration,
                'image_path' => $hikeImage,
                'update_date' => $update,
            ];
            $query = "UPDATE hikes SET hike_name=:hikename, content=:hikecontent, update_date=:update_date, distance=:hikedistance, elevation_gain=:hikeelevation, duration=:hikeduration, image_path=:hikeimage WHERE hike_id = $hikeID";

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
                require_once '../controler/sendMailUpdate.php';
                header("Location:/hike?hikeID=$hikeID");
                unset($_SESSION["hikeID"]);
            } else
            {
                echo'ERROR';
            }
        }
    }
}

$update = new UpdateHike();
$update->updateHike();