<?php
require '../Model/userInfo.php';

$user= new UserInfo;
$userInfo = $user->userInfo();
echo '<pre>';
var_dump($userInfo);
echo '</pre>';

$firstname = $userInfo["firstname"];
$lastname = $userInfo["lastname"];
$nickname = $userInfo["nickname"];
$mail = $userInfo["mail"];
$password = $userInfo["password"];
$city = $userInfo["city"];
$country = $userInfo["country"];


?>

<form action="../Model/updateUser.php" method="POST">
        <input type="text" name="firstname" placeholder="Firstname" value=<?= $firstname?>>
        <br>
        <input type="text" name="lastname" placeholder="Lastname" value=<?= $lastname ?>>
        <br>
        <input type="text" name="nickname" placeholder="Nickname" value=<?= $nickname ?>>
        <br>
        <input type="text" name="mail" placeholder="Mail" value=<?= $mail ?>>
        <br>
        <input type="password" name="password" placeholder="Password" value=<?= $password ?>>
        <br>
        <input type="text" name="city" placeholder="City" value=<?= $city ?>>
        <br>
        <input type="text" name="country" placeholder="Country" value=<?= $country ?>>
        <br>
        <button type="submit" name="submit">Sign up</button>
</form>