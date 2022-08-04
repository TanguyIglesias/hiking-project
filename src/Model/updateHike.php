<?php


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

            if(empty($_POST["hike_name"]))
            {
                header("Location:/update");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {
                $hikeName = test_input($_POST['hike_name']);
                if(!preg_match("/^[a-zA-Z-' ]*$/", $hikeName))
                {
                    header("Location:/update");
                    $_SESSION['nameErr'] = "Seul les lettres et les espaces sont autorisés.";
                    exit();
                }
            }

            if(empty($_POST["content"]))
            {
                header("Location:/update");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();                
            }else
            {
                $hikeContent = test_input($_POST["content"]);
                if(!preg_match("/^[a-zA-Z-' ]*$/", $hikeContent))
                {
                    header("Location:/update");
                    $_SESSION['nameErr'] = "Seul les lettres et les espaces sont autorisés.";
                    exit();
                }
            }

            if(empty($_POST["distance"]))
            {
                header("Location:/update");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {
                $hikeDistance = test_input($_POST["distance"]);
                if(!preg_match("/^[a-zA-Z-' ]*$/", $hikeDistance))
                {
                    header("Location:/update");
                    $_SESSION['nameErr'] = "Seul les chiffres sont autorisés.";
                    exit();
                }
            }

            if(empty($_POST["elevation"]))
            {
                header("Location:/update");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else 
            {
                $hikeElevation = test_input($_POST["elevation"]);
                if(!preg_match("/^[a-zA-Z-' ]*$/", $hikeElevation))
                {
                    header("Location:/update");
                    $_SESSION['nameErr'] = "Seul les chiffres sont autorisés.";
                    exit();
                }
            }
            if(empty($_POST["duration"]))
            {
                header("Location:/update");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else 
            {
                $hikeDuration = test_input($_POST["duration"]);
                if(!preg_match("/^[a-zA-Z-' ]*$/", $hikeDuration))
                {
                    header("Location:/update");
                    $_SESSION['nameErr'] = "Seul les chiffres sont autorisés.";
                    exit();
                }
            }

            if(empty($_POST["image_path"]))
            {
                header("Location:/update");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else 
            {
                $hikeImage = test_input($_POST["image_path"]);
                if(!preg_match("/^[a-zA-Z-' ]*$/", $hikeImage))
                {
                    header("Location:/update");
                    $_SESSION['nameErr'] = "Seul les chiffres sont autorisés.";
                    exit();
                }
            }
            
                $user_id = $_SESSION['user_id'];
        
            
            $data = [
                'hike_name' => $hikeName,
                'content' => $hikeContent,
                'distance' => $hikeDistance,
                'elevation' => $hikeElevation,
                'duration' => $hikeDuration,
                'image_path' => $hikeImage,
            ];
            $query = "UPDATE users SET hike_name=:hikename, content=:hikecontent, distance=:hikedistance, elevation=:hikeelevation, duration=:hikeduration, image_path=:hikeimage WHERE user_id =$user_id";

            $query_run = $db->prepare($query);
            $query_run->bindParam(':hikename', $data['hike_name']);
            $query_run->bindParam(':hikecontent', $data['content']);
            $query_run->bindParam(':hikedistance', $data['distance']);
            $query_run->bindParam(':hikeelevation', $data['elevation']);
            $query_run->bindParam(':hikeduration', $data['duration']);
            $query_run->bindParam(':hikeimage', $data['image_path']);
            if($query_run->execute())
            {
                require_once '../controler/sendMailUpdate.php';
                header("Location:/user");
            }else
            {
                echo'ERROR';
            }

        }
    }
}

$update = new UpdateForm();
$update->updateForm();