<?php
if (!isset($_SESSION)) { session_start(); }
require '../Model/userInfo.php';
$user= new UserInfo;
$userInfo = $user->userInfo();
$firstname = $userInfo["firstname"];
$lastname = $userInfo["lastname"];
$nickname = $userInfo["nickname"];
$mail = $userInfo["mail"];
$password = $userInfo["password"];
$city = $userInfo["city"];
$country = $userInfo["country"];
$title='Update User';
require_once '../view/head.php';
?>
<body>
        <?php require_once '../view/header.php';?>
        <br>
        <form action="/updateUser" method="POST">
                <input type="text" name="firstname" placeholder="Firstname" value=<?= $firstname?>><span style="color: red">*</span>
                <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['nameErr'])) ? $_SESSION['nameErr'] : "" ?></span>
                <br>
                <input type="text" name="lastname" placeholder="Lastname" value=<?= $lastname ?>><span style="color: red">*</span>
                <br>
                <input type="text" name="nickname" placeholder="Nickname" value=<?= $nickname ?>><span style="color: red">*</span>
                <br>
                <input type="text" name="mail" placeholder="Mail" value=<?= $mail ?>><span style="color: red">*</span><span style="color:red"><?= (isset($_SESSION['mailErr'])) ? $_SESSION['mailErr'] : "" ?></span>
                <br>
                <input type="password" name="password" placeholder="Password" ><span style="color: red">*</span>
                <br>
                <input type="text" name="city" placeholder="City" value=<?= $city ?>>
                <br>
                <input type="text" name="country" placeholder="Country" value=<?= $country ?>>
                <br>
                <button type="submit" name="submit">Update</button>
        </form>
        
        <?php 
        unset($_SESSION["error"]); 
        unset($_SESSION['nameErr']);
        unset($_SESSION['mailErr']);
        require_once '../view/footer.php';
        ?>
</body>
