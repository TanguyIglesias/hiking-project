<?php 
$title='Delete User';   
require_once '../view/head.php';
?>
<body>
<?php require_once '../view/header.php';?>
<br>
        <form action="/deleteUser" method="POST">

                <input type="text" name="deleteUserId" placeholder="User ID to Delete">
                <br>
                <button type="submit" name="submit">Sign up</button>
        </form>
<?php require_once '../view/footer.php';?>

