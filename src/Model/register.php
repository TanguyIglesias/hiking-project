<?php 
require '../Model/userCheck.php';
if (!isset($_SESSION)) { session_start(); }

class SetSession extends Database {

    function setUserInfo(){

        $db=$this->connectDb();

        $user= new UserCheck;
        $userInfo = $user->userCheck();

/*         echo '<pre>';
        var_dump($userInfo);
        echo '</pre>';

        var_dump($userInfo); */

        $_SESSION["user_id"] = $userInfo["user_id"];
        $_SESSION["firstname"] = $userInfo["firstname"];
        $_SESSION["lastname"] = $userInfo["lastname"];
        $_SESSION["nickname"] = $userInfo["nickname"];
        $_SESSION["mail"] = $userInfo["mail"];
        $_SESSION["password"] = $userInfo["password"];
        $_SESSION["city"] = $userInfo["city"];
        $_SESSION["country"] = $userInfo["country"];
        $_SESSION["user_admin"] = $userInfo["user_admin"];

        var_dump($_SESSION);


/*         if (isset($_POST['login'])) {

            $_SESSION["user_id"] = $userInfo["user_id"];
            $_SESSION["firstname"] = $userInfo["firstname"];
            $_SESSION["lastname"] = $userInfo["lastname"];
            $_SESSION["nickname"] = $userInfo["nickname"];
            $_SESSION["mail"] = $userInfo["mail"];
            $_SESSION["password"] = $userInfo["password"];
            $_SESSION["city"] = $userInfo["city"];
            $_SESSION["country"] = $userInfo["country"];

            echo '<pre>';
            var_dump($_SESSION);
            echo '</pre>';

            echo 'Session is SET';
        } */

/*         if (isset($_SESSION['firstname'])){
            header("Location:/");
        }

        else{
            echo'ERROR';
        } */

    }
}

$send = new SetSession();
$send->setUserInfo();
?>

<a href="/"><button>Homepage</button></a>