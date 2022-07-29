<?php

class SendHike extends Database
{

    public function sendHike() {



        $db=$this->connectDb();

        if (isset($_POST['submit']))
        {
        
            $hike_name = $_POST['hike_name'];
            $distance = $_POST['distance'];
            $elevation_gain = $_POST['elevation_gain'];
            $duration = $_POST['duration'];
            $creation_date = $_POST['creation_date'];
            $update_date = $_POST['update_date'];
            $image_path = $_POST['image_path'];
            $content = $_POST['content'];
            $userId = 3;

            // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
        if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] == 0)
        {
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['image_path']['size'] <= 8000000)
            {
                // Testons si l'extension est autorisée
                $fileInfo = pathinfo($_FILES['image_path']['name']);
                $extension = $fileInfo['extension'];
                $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                if (in_array($extension, $allowedExtensions))
                {
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['image_path']['tmp_name'], '../image/' . basename($_FILES['/application/src/image']['name']));
                        echo "L'envoi a bien été effectué !";
                }
            }
        }
        
        
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