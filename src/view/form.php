<?php 
if (!isset($_SESSION)) { session_start(); }$title='Sign In';
// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';
require_once '../view/head.php';
?>

<body>
    <?php require_once '../view/header.php'?>
    <br>
    <p style="color:red">* Obligatoire</p>
    <form action="/sendForm" method="POST">
        <input type="text" name="firstname" placeholder="Firstname"><span style="color: red">*</span> 
        <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['nameErr'])) ? $_SESSION['nameErr'] : "" ?></span>
        <br>
        <input type="text" name="lastname" placeholder="Lastname"><span style="color: red">*</span>
        <br>
        <input type="text" name="nickname" placeholder="Nickname"><span style="color: red">*</span>
        <br>
        <input type="text" name="mail" placeholder="Mail"><span style="color: red">*</span><span style="color:red"><?= (isset($_SESSION['mailErr'])) ? $_SESSION['mailErr'] : "" ?></span>
        <br>
        <input type="password" name="password" placeholder="Password"><span style="color: red">*</span>
        <br>
        <input type="text" name="city" placeholder="City">
        <br>
        <input type="text" name="country" placeholder="Country">
        <br>
        <button type="submit" name="submit">Sign up</button>
        <p class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['error'])) ? $_SESSION['error'] : "" ?></p>

    </form>
    <?php 
        unset($_SESSION["error"]); 
        unset($_SESSION['nameErr']);
        unset($_SESSION['mailErr']);
        require_once '../view/footer.php';
     ?>

</body>
</html>