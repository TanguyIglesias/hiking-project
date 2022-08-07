<?php 
//if (!isset($_SESSION)) { session_start(); }$title='Sign In';
// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';
$title = 'Sign In';
require_once '../view/head.php';
?>

<body>
    <?php require_once '../view/header.php'?>
    <main class="form-main">
        <form action="/sendForm" method="POST">
            <p style="color:red">* Obligatoire</p>
            <span style="color: red">*</span> 
            <input type="text" name="firstname" placeholder="Firstname">
            <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['firstnameErr'])) ? $_SESSION['firstnameErr'] : "" ?></span>
            
            <span style="color: red">*</span>
            <input type="text" name="lastname" placeholder="Lastname">
            <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['lastnameErr'])) ? $_SESSION['lastnameErr'] : "" ?></span>
            
            <span style="color: red">*</span>
            <input type="text" name="nickname" placeholder="Nickname">
            <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['nicknameDupes'])) ? $_SESSION['nicknameDupes'] : "" ?></span>
            <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['nicknameErr'])) ? $_SESSION['nicknameErr'] : "" ?></span>
            
            <span style="color: red">*</span>
            <input type="text" name="mail" placeholder="Mail">
            <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['mailDupes'])) ? $_SESSION['mailDupes'] : "" ?></span>
            <span style="color:red"><?= (isset($_SESSION['mailErr'])) ? $_SESSION['mailErr'] : "" ?></span>
            
            <span style="color: red">*</span>
            <input type="password" name="password" placeholder="Password">
            
            <input type="text" name="city" placeholder="City">
            <span style="color:red"><?= (isset($_SESSION['cityErr'])) ? $_SESSION['cityErr'] : "" ?></span>
            
            <input type="text" name="country" placeholder="Country">
            <span style="color:red"><?= (isset($_SESSION['countryErr'])) ? $_SESSION['countryErr'] : "" ?></span>
            <br>
            <button type="submit" name="submit">Sign up</button>
            <p class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['error'])) ? $_SESSION['error'] : "" ?></p>

        </form>
        <a href="/"><button type="button" name="HomePage">Homepage</button></a>
        <?php 
            unset($_SESSION["error"]); 
            unset($_SESSION['firstnameErr']);
            unset($_SESSION['lastnameErr']);
            unset($_SESSION['nicknameDupes']);
            unset($_SESSION['nicknameErr']);
            unset($_SESSION['nameErr']);
            unset($_SESSION['mailDupes']);
            unset($_SESSION['mailErr']);
            unset($_SESSION['cityErr']);
            unset($_SESSION['countryErr']);
            
            
        ?>
    </main>

    <?php require_once '../view/footer.php'?>
</body>
