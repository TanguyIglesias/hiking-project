<?php 
session_start();
$title='Sign In';
require_once '../view/head.php';
?>

<body>
    <?php require_once '../view/header.php'?>
    <br>
    <form action="/sendForm" method="POST">
        <input type="text" name="firstname" placeholder="Firstname">
        <br>
        <input type="text" name="lastname" placeholder="Lastname">
        <br>
        <input type="text" name="nickname" placeholder="Nickname">
        <br>
        <input type="text" name="mail" placeholder="Mail">
        <br>
        <input type="password" name="password" placeholder="Password">
        <br>
        <input type="text" name="city" placeholder="City">
        <br>
        <input type="text" name="country" placeholder="Country">
        <br>
        <button type="submit" name="submit">Sign up</button>
    </form>

    <?php require_once '../view/footer.php';?>

</body>
</html>