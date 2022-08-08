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
                if($_SESSION['firstname'] == $_POST['firstname'])
                {
                    $firstname = $_POST['firstname'];
                }else
                {
                    
                    $firstname = test_input($_POST['firstname']);
                    if(!preg_match("/^([A-Za-z \-]+(?:\'|&#0*39;)*)*[A-Za-z \-]+$/", $firstname))
                    {
                        header("Location:/update");
                        $_SESSION['firstnameErr'] = "Seul les lettres et les espaces sont autorisés.";
                        exit();
                    }
                }
                
            }

            if(empty($_POST["lastname"]))
            {
                header("Location:/update");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();                
            }else
            {
                if($_SESSION['lastname'] == $_POST['lastname'])
                {
                    $lastname = $_POST['lastname'];
                }else
                {
                    $lastname = test_input($_POST["lastname"]);
                    if(!preg_match("/^([A-Za-z \-]+(?:\'|&#0*39;)*)*[A-Za-z \-]+$/", $lastname))
                    {
                        header("Location:/update");
                        $_SESSION['lastnameErr'] = "Seul les lettres et les espaces sont autorisés.";
                        exit();
                    }
                }
                
            }

            if(empty($_POST["nickname"]))
            {
                header("Location:/update");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else
            {
                if($_SESSION['nickname'] == $_POST['nickname'])
                {
                    $nickname = $_POST['nickname'];
                }else
                {
                    $nickname = test_input($_POST["nickname"]);
                    $nickname_req = $db->query("SELECT * FROM users WHERE nickname = '$nickname'");
                    if($nickname_req->rowCount()>0)
                    {
                        header("Location:/update");
                        $_SESSION['nicknameDupes'] = 'Ce nickname existe déjà';
                        exit();
                    }else
                    {
                        if(!preg_match("/^([A-Za-z \-]+(?:\'|&#0*39;)*)*[A-Za-z \-]+$/", $nickname))
                        {
                            header("Location:/update");
                            $_SESSION['nicknameErr'] = "Seul les lettres et les espaces sont autorisés.";
                            exit();
                        }
                    }
                    
                }
                
            }

            if(empty($_POST["mail"]))
            {
                header("Location:/update");
                $_SESSION['error'] = 'Formulaire Incomplet';
                exit();
            }else 
            {
                if($_SESSION['mail'] == $_POST['mail'])
                {
                    $mail = $_POST['mail'];
                }else
                {

                    $mail = test_input($_POST["mail"]);
                    $mail_req = $db->query("SELECT * FROM users WHERE mail='$mail'");
                    if($mail_req->rowCount()>0)
                    {
                        header("Location:/update");
                        $_SESSION['mailDupes'] = 'Cette adresse mail existe déjà';
                        exit();
                    }else
                    {
                        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
                        {
                            header("Location:/update");
                            $_SESSION['mailErr'] = "Invalid email format";
                            exit();
                        }
                    }
                
                }
                
            }
            if(empty($_POST['password'])){

                $password = $_SESSION['password'];

            }else{

                $password = test_input($_POST["password"]);
                $password = password_hash($password, PASSWORD_DEFAULT);
            }
            
            if (empty($_POST['city']))
                {
                    header("Location:/update");
                    $_SESSION['error'] = 'Formulaire Incomplet';
                    exit();
                }
                    if($_SESSION['city'] == $_POST['city'])
                    {
                        $city = $_POST['city'];
                    }else
                    {
                        $city = test_input($_POST['city']);
                        if(!preg_match("/^([A-Za-z \-]+(?:\'|&#0*39;)*)*[A-Za-z \-]+$/", $city))
                        {
                            header("Location:/update");
                            $_SESSION['cityErr'] = "Seul les lettres et les espaces sont autorisés.";
                            exit();
                        }
                    }
                    

                if (empty($_POST['country']))
                {
                    header("Location:/update");
                    $_SESSION['error'] = 'Formulaire Incomplet';
                    exit();
                }
                    if($_SESSION['country'] == $_POST['country'])
                    {
                        $country = $_POST['country'];
                    }else
                    {
                        $country = test_input($_POST['country']);
                        if(!preg_match("/^([A-Za-z \-]+(?:\'|&#0*39;)*)*[A-Za-z \-]+$/", $country))
                        {
                            header("Location:/update");
                            $_SESSION['countryErr'] = "Seul les lettres et les espaces sont autorisés.";
                            exit();
                        }
                    }
                    
                $user_id = $_SESSION['user_id'];
        
            
            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'nickname' => $nickname,
                'mail' => $mail,
                'password' => $password,
                'city' => $city,
                'country' => $country,
            ];
            
            $query = "UPDATE users SET firstname=:firstname, lastname=:lastname, nickname=:nickname, mail=:mail, password=:password, city=:city, country=:country WHERE user_id =$user_id";

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