<?php


class UpdateForm extends Database
{

    public function updateForm() {
        if (!isset($_SESSION)) { session_start(); }
        $db=$this->connectDb();

        if (isset($_POST['submit']))
        {

            $firstname = $lastname = $nickname = $mail = $password = "";

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }

              if(empty($_POST["firstname"]))
              {
                  header("Location:/update");
                  $_SESSION['error'] = 'Formulaire Incomplet';
                  exit();
              }else
              {
                  $firstname = test_input($_POST['firstname']);
                  if(!preg_match("/^[a-zA-Z-' ]*$/", $firstname))
                  {
                      header("Location:/update");
                      $_SESSION['nameErr'] = "Seul les lettres et les espaces sont autorisés.";
                      exit();
                  }
              }

              if(empty($_POST["lastname"]))
              {
                  header("Location:/update");
                  $_SESSION['error'] = 'Formulaire Incomplet';
                  exit();                
              }else
              {
                  $lastname = test_input($_POST["lastname"]);
                  if(!preg_match("/^[a-zA-Z-' ]*$/", $lastname))
                  {
                      header("Location:/update");
                      $_SESSION['nameErr'] = "Seul les lettres et les espaces sont autorisés.";
                      exit();
                  }
              }

              if(empty($_POST["nickname"]))
              {
                  header("Location:/update");
                  $_SESSION['error'] = 'Formulaire Incomplet';
                  exit();
              }else
              {
                  $nickname = test_input($_POST["nickname"]);
                  if(!preg_match("/^[a-zA-Z-' ]*$/", $nickname))
                  {
                      header("Location:/update");
                      $_SESSION['nameErr'] = "Seul les lettres et les espaces sont autorisés.";
                      exit();
                  }
              }

              if(empty($_POST["mail"]))
              {
                  header("Location:/update");
                  $_SESSION['error'] = 'Formulaire Incomplet';
                  exit();
              }else 
              {
                  $mail = test_input($_POST["mail"]);
                  if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
                  {
                      header("Location:/update");
                      $_SESSION['mailErr'] = "Invalid email format";
                      exit();
                  }
              }
              if(empty($_POST["password"]))
              {
                  header("Location:/update");
                  $_SESSION['error'] = 'Formulaire Incomplet';
                  exit();
              }else 
              {
                  $password = test_input($_POST["password"]);
                  $password = password_hash($password, PASSWORD_DEFAULT);
              }

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
            $query = "UPDATE users SET firstname=:firstname, lastname=:lastname, nickname=:nickname, mail=:mail, password=:password, city=:city, country=:country WHERE user_id = 55";

            $query_run = $db->prepare($query);
            $query_run->bindParam(':firstname', $data['firstname']);
            $query_run->bindParam(':lastname', $data['lastname']);
            $query_run->bindParam(':nickname', $data['nickname']);
            $query_run->bindParam(':mail', $data['mail']);
            $query_run->bindParam(':password', $data['password']);
            $query_run->bindParam(':city', $data['city']);
            $query_run->bindParam(':country', $data['country']);
            if($query_run->execute())
            {
                header("Location:/update");
            }else
            {
                echo'ERROR';
            }

        }
    }
}

$update = new UpdateForm();
$update->updateForm();