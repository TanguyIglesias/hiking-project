<?php


class SendForm extends Database
{

    public function sendForm() {
        if (!isset($_SESSION)) { session_start(); }


        $db=$this->connectDb();

        if (isset($_POST['submit']))
        {   
            $firstname = $lastname = $nickname = $mail = $password = $city = $country = "";

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                //$data = ucfirst($data); il met majuscule à la première lettre d'un email ce qui fausse l'adresse. A mettre séparément là où c'est nécessaire.
                return $data;
            }

            
                if(empty($_POST["firstname"]))
                {
                    header("Location:/registration");
                    $_SESSION['error'] = 'Formulaire Incomplet';
                    exit();
                }else
                {
                    $firstname = test_input($_POST['firstname']);
                    if(!preg_match("/^[a-zA-Z-àâáçéèèêëìîíïôòóùûüÂÊÎÔúÛÄËÏÖÜÀÆæÇÉÈŒœÙñý' ]*$/", $firstname))
                    {
                        header("Location:/registration");
                        $_SESSION['firstnameErr'] = "Seul les lettres et les espaces sont autorisés.";
                        exit();
                    }
                }

                if(empty($_POST["lastname"]))
                {
                    header("Location:/registration");
                    $_SESSION['error'] = 'Formulaire Incomplet';
                    exit();                
                }else
                {
                    $lastname = test_input($_POST["lastname"]);
                    if(!preg_match("/^[a-zA-Z-àâáçéèèêëìîíïôòóùûüÂÊÎÔúÛÄËÏÖÜÀÆæÇÉÈŒœÙñý' ]*$/", $lastname))
                    {
                        header("Location:/registration");
                        $_SESSION['lastnameErr'] = "Seul les lettres et les espaces sont autorisés.";
                        exit();
                    }
                }

                if(empty($_POST["nickname"]))
                {
                    header("Location:/registration");
                    $_SESSION['error'] = 'Formulaire Incomplet';
                    exit();
                }else
                {
                    $nickname = test_input($_POST["nickname"]);
                    $nickname_req = $db->query("SELECT * FROM users WHERE nickname = '$nickname'");
                    if($nickname_req->rowCount()>0)
                    {
                        header("Location:/registration");
                        $_SESSION['nicknameDupes'] = 'Ce nickname existe déjà';
                        exit();
                    }else
                    {
                        if(!preg_match("/^[a-zA-Z0-9a-àâáçéèèêëìîíïôòóùûüÂÊÎÔúÛÄËÏÖÜÀÆæÇÉÈŒœÙñý' ]*$/", $nickname))
                        {
                            header("Location:/registration");
                            $_SESSION['nicknameErr'] = "Seul les lettres et les espaces sont autorisés.";
                            exit();
                        }
                    }
                    
                }

                if(empty($_POST["mail"]))
                {
                    header("Location:/registration");
                    $_SESSION['error'] = 'Formulaire Incomplet';
                    exit();
                }else 
                {

                    $mail = test_input($_POST["mail"]);
                    $mail_req = $db->query("SELECT * FROM users WHERE mail='$mail'");
                    if($mail_req->rowCount()>0)
                    {
                        header("Location:/registration");
                        $_SESSION['mailDupes'] = 'Cette adresse mail existe déjà';
                        exit();
                    }else
                    {
                        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
                        {
                            header("Location:/registration");
                            $_SESSION['mailErr'] = "Invalid email format";
                            exit();
                        }
                    }
                }
                if(empty($_POST["password"]))
                {
                    header("Location:/registration");
                    $_SESSION['error'] = 'Formulaire Incomplet';
                    exit();
                }else 
                {
                    $password = test_input($_POST["password"]);
                    $password = password_hash($password, PASSWORD_DEFAULT);
                }
                if (!empty($_POST['city']))
                {
                    $city = test_input($_POST['city']);
                    if(!preg_match("/^[a-zA-Z-àâáçéèèêëìîíïôòóùûüÂÊÎÔúÛÄËÏÖÜÀÆæÇÉÈŒœÙñý' ]*$/", $city))
                    {
                        header("Location:/registration");
                        $_SESSION['cityErr'] = "Seul les lettres et les espaces sont autorisés.";
                        exit();
                    }
                }
                if (!empty($_POST['country']))
                {
                    $city = test_input($_POST['country']);
                    if(!preg_match("/^[a-zA-Z-àâáçéèèêëìîíïôòóùûüÂÊÎÔúÛÄËÏÖÜÀÆæÇÉÈŒœÙñý' ]*$/", $country))
                    {
                        header("Location:/registration");
                        $_SESSION['countryErr'] = "Seul les lettres et les espaces sont autorisés.";
                        exit();
                    }
                }
            
            $user_admin= 0;
        
        
            $query = "INSERT INTO users (firstname, lastname, nickname, mail, password, city, country, user_admin) VALUES (:firstname, :lastname, :nickname, :mail, :password, :city, :country, :user_admin)";
            $query_run = $db->prepare($query);
        
            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'nickname' => $nickname,
                'mail' => $mail,
                'password' => $password,
                'city' => $city,
                'country' => $country,
                'user_admin' => $user_admin,
            ];
            $query_run->bindParam(':firstname',$data['firstname']);
            $query_run->bindParam(':lastname',$data['lastname']);
            $query_run->bindParam(':nickname',$data['nickname']);
            $query_run->bindParam(':mail',$data['mail']);
            $query_run->bindParam(':password',$data['password']);
            $query_run->bindParam(':city',$data['city']);
            $query_run->bindParam(':country',$data['country']);
            $query_run->bindParam(':user_admin',$data['user_admin']);
            if ($query_run->execute())
            {
                require_once '../controler/sendMailRegister.php';
                header("Location:/");
            }else{
                echo'ERROR';
            }
        
        } 
    }
}

$send = new SendForm();
$send->sendform();