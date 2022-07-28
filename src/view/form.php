<?php session_start()?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <p>
        

    </p>
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
</body>
</html>