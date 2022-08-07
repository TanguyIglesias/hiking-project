<?php 
$title='Delete Hike';   
require_once '../view/head.php';
?>
<body>
<?php require_once '../view/header.php';?>
<br>
        <form action="/deleteHike" method="POST">

                <input type="text" name="deleteHikeId" placeholder="Hike ID to Delete">
                <br>
                <button type="submit" name="submit">Delete</button>
        </form>
<?php require_once '../view/footer.php';?>

