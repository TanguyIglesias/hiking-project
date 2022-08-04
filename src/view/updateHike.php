<?php
if (!isset($_SESSION)) { session_start(); }
require_once '../Model/hikeInfo.php';
$user= new HikeInfo;
$hikeInfo = $hike->hikeInfo('5');
// echo '<pre>';
// var_dump($hike);
// echo '</pre>';
$hikeName = $hikeInfo["hike_name"];
$hikeContent= $hikeInfo["content"];
$hikeDistance = $hikeInfo["distance"];
$hikeElevation = $hikeInfo["elevation_gain"];
$hikeDuration = $hikeInfo["duration"];
$hikeImage = $hikeInfo["image_path"];
$title='Update Hike';
require_once '../view/head.php';
?>
<body>
        <?php require_once '../view/header.php';?>
        <br>
        <form action="/updateHike" method="POST">
                <input type="text" name="hikename" placeholder="Hikename" value=<?= $hikeName?>><span style="color: red">*</span>
                <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['nameErr'])) ? $_SESSION['nameErr'] : "" ?></span>
                <br>
                <input type="text" name="hikecontent" placeholder="Hikecontent" value=<?= $hikeContent ?>><span style="color: red">*</span>
                <br>
                <input type="text" name="hikedistance" placeholder="Hikedistance" value=<?= $hikeDistance ?>><span style="color: red">*</span>
                <br>
                <input type="text" name="hikeelevation" placeholder="Hikeelevation" value=<?= $hikeElevation ?>><span style="color: red">*</span>
                <br>
                <input type="text" name="Hikeduration" placeholder="Hikeduration" value=<?= $hikeDuration ?>><span style="color: red">*</span>
                <br>
                <input type="image" name="Hikeimage" placeholder="Hikeimage" value=<?= $hikeImage ?>><span style="color: red">*</span>
                <br>
                <button type="submit" name="submit">Update</button>
        </form>
        
        <?php 
        unset($_SESSION["error"]); 
        unset($_SESSION['nameErr']);
        require_once '../view/footer.php';
        ?>
</body>