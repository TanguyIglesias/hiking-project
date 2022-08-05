<?php 
//session_start();
require_once '../Model/Tag.php';
$title='Sign In';
require_once '../view/head.php';
$tag = new Tag();
$getTag = $tag->getTag();
?>

<body>
    <?php require_once '../view/header.php'?>
    <br>
    <form action="/sendHike" method="POST" enctype="multipart/form-data">
        <input type="text" name="hike_name" placeholder="Nom du hike">
        <?= (isset($_SESSION['nameErr'])) ? $_SESSION['nameErr'] : "" ?>
        <br>
        <input type="text" name="distance" placeholder="Distance">
        <?= (isset($_SESSION['distanceErr'])) ? $_SESSION['distanceErr'] : "" ?>
        <br>
        <input type="text" name="elevation_gain" placeholder="Dénivellation">
        <?= (isset($_SESSION['elevationErr'])) ? $_SESSION['elevationErr'] : "" ?>
        <br>
        <input type="time" name="duration" placeholder="Durée">
        <?= (isset($_SESSION['durationErr'])) ? $_SESSION['durationErr'] : "" ?>
        <br>
        <!-- <input type="text" name="creation_date" placeholder="Date de création">
        <br>
        <input type="text" name="update_date" placeholder="Date de modification">
        <br> -->
        <input type="text" name="content" placeholder="Description">
        <?= (isset($_SESSION['contentErr'])) ? $_SESSION['contentErr'] : "" ?>
        <br>
        <input type="text" name="image_path" placeholder="url image"><span style="color:red">
        <?= (isset($_SESSION['urlErr'])) ? $_SESSION['urlErr'] : "" ?></span>
        <br>
        <?php foreach ( $getTag as $key => $value):  ?>
                <input type="checkbox" value="<?= $value['tag_id']?>" name="tag_id[]"><?= $value['tag_name']?>  
        <?php endforeach?>
        <br>
        <button type="submit" name="submit">Envoyer</button>
        <p class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['error'])) ? $_SESSION['error'] : "" ?></p>

    </form>

    <?php
    unset($_SESSION["urlErr"]);  
    unset($_SESSION["error"]); 
    unset($_SESSION['nameErr']);
    unset($_SESSION['distanceErr']);
    unset($_SESSION['elevationErr']);
    unset($_SESSION['durationErr']);
    unset($_SESSION['contentErr']);
    unset($_SESSION['nameDupes']);
    unset($_SESSION['tagErr']);
    require_once '../view/footer.php';?>
<a href="/"><button type="button" name="HomePage">Homepage</button></a>
</body>
</html>