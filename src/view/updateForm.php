<?php
//if (!isset($_SESSION)) { session_start(); }
require '../Model/userInfo.php';
$user= new UserInfo;
// $userInfo = $user->userInfo();
$firstname = $_SESSION["firstname"];
$lastname = $_SESSION["lastname"];
$nickname = $_SESSION["nickname"];
$mail = $_SESSION["mail"];
$password = $_SESSION["password"];
$city = $_SESSION["city"];
$country = $_SESSION["country"];
$title='Update User';
require_once '../view/head.php';
?>
<body>
        <?php require_once '../view/header.php';?>

        <main class="updateForm-main">
                <form action="/updateUser" method="POST">
                        <span style="color: red">*</span>
                        <input type="text" name="firstname" placeholder="Firstname" value=<?= $firstname?>>
                        <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['firstnameErr'])) ? $_SESSION['firstnameErr'] : "" ?></span>
                        
                        <span style="color: red">*</span>
                        <input type="text" name="lastname" placeholder="Lastname" value=<?= $lastname ?>>
                        <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['lastnameErr'])) ? $_SESSION['lastnameErr'] : "" ?></span>
                        
                        <span style="color: red">*</span>
                        <input type="text" name="nickname" placeholder="Nickname" value=<?= $nickname ?>>
                        <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['nicknameDupes'])) ? $_SESSION['nicknameDupes'] : "" ?></span>
                        <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['nicknameErr'])) ? $_SESSION['nicknameErr'] : "" ?></span>
                        
                        <span style="color: red">*</span>
                        <input type="text" name="mail" placeholder="Mail" value=<?= $mail ?>>
                        <span style="color:red"><?= (isset($_SESSION['mailDupes'])) ? $_SESSION['mailDupes'] : "" ?></span>
                        <span style="color:red"><?= (isset($_SESSION['mailErr'])) ? $_SESSION['mailErr'] : "" ?></span>
                        
                        <span style="color: red">*</span>
                        <input type="password" name="password" placeholder="Password" >
                        
                        <span style="color: red">*</span>
                        <input type="text" name="city" placeholder="City" value=<?= $city ?>>
                        <span style="color:red"><?= (isset($_SESSION['cityErr'])) ? $_SESSION['cityErr'] : "" ?></span>
                        
                        <span style="color: red">*</span>
                        <input type="text" name="country" placeholder="Country" value=<?= $country ?>>
                        <span style="color:red"><?= (isset($_SESSION['countryErr'])) ? $_SESSION['countryErr'] : "" ?></span>
                        <br>
                        <button type="submit" name="submit">Update</button>
                        <p class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['error'])) ? $_SESSION['error'] : "" ?></p>
                </form>
                
                <?php 
                unset($_SESSION["error"]); 
                unset($_SESSION['firstnameErr']);
                unset($_SESSION['lastnameErr']);
                unset($_SESSION['nicknameErr']);
                unset($_SESSION['nicknameDupes']);
                unset($_SESSION['mailErr']);
                unset($_SESSION['mailDupes']);
                unset($_SESSION['cityErr']);
                unset($_SESSION['countryErr']);
                ?>
                <a href="/"><button type="button" name="HomePage">Homepage</button></a>
        </main>

        <?php require_once '../view/footer.php'?>
</body>
