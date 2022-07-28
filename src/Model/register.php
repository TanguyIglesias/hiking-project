<?php 
require '../Model/userInfo.php';



function setUserInfo(){

    $user= new UserInfo;
    $userInfo = $user->userInfo();
    
    echo '<pre>';
    var_dump($userInfo);
    echo '</pre>';

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
}
setUserInfo();
?>
