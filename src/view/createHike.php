<?php 
session_start();
$title='Sign In';
require_once '../view/head.php';
?>

<body>
    <?php require_once '../view/header.php'?>
    <br>
    <form action="/sendHike" method="POST" enctype="multipart/form-data">
        <input type="text" name="hike_name" placeholder="Nom du hike">
        <br>
        <input type="text" name="distance" placeholder="Distance">
        <br>
        <input type="text" name="elevation_gain" placeholder="Dénivellation">
        <br>
        <input type="text" name="duration" placeholder="Durée">
        <br>
        <input type="text" name="creation_date" placeholder="Date de création">
        <br>
        <input type="text" name="update_date" placeholder="Date de modification">
        <br>
        <input type="text" name="content" placeholder="Description">
        <br>
        <input type="text" name="image_path" placeholder="url image"><span style="color:red"><?= (isset($_SESSION['urlErr'])) ? $_SESSION['urlErr'] : "" ?></span>
        <br>
        <button type="submit" name="submit">Envoyer</button>
    </form>

    <?php 
    require_once '../view/footer.php';
    unset($_SESSION["urlErr"]); 
    ?>

</body>
</html>