<?php
if (!isset($_SESSION)) { session_start(); }
require_once '../Model/hikeInfo.php';
$hike= new HikeInfo;
$hikeID = $_SESSION["hikeID"];
$hikeInfo = $hike->hikeInfo($hikeID);
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
$hikeName = $hikeInfo["hike_name"];
$hikeContent= $hikeInfo["content"];
$hikeDistance = $hikeInfo["distance"];
$hikeElevation = $hikeInfo["elevation_gain"];
$hikeDuration = $hikeInfo["duration"];
$hikeImage = $hikeInfo["image_path"];
$hikeUpdateDate = $hikeInfo["update_date"];
$title='Update Hike';
require_once '../view/head.php';
?>
<body>
        <?php require_once '../view/header.php';?>
        <br>
        <form action="/updateHikes" method="POST">

                <input type="text" name="hikename" placeholder="Hike name" value=<?= $hikeName?>><span style="color: red">*</span>
                <span class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['nameErr'])) ? $_SESSION['nameErr'] : "" ?></span>
                <br>
                <input type="text" name="hikecontent" placeholder="Hike content" value=<?= $hikeContent ?>><span style="color: red">*</span>
                <br>
                <input type="text" name="hikedistance" placeholder="Hike distance" value=<?= $hikeDistance ?>><span style="color: red">*</span>
                <br>
                <input type="text" name="hikeelevation" placeholder="Hike elevation" value=<?= $hikeElevation ?>><span style="color: red">*</span>
                <br>
                <input type="text" name="hikeduration" placeholder="Hike duration" value=<?= $hikeDuration ?>><span style="color: red">*</span>
                <br>
                <input type="text" name="hikeimage" placeholder="Hike image" value=<?= $hikeImage ?>><span style="color: red">*</span>
                <br>
                <p>Date de la dernière modification : <?= $hikeUpdateDate?></p>
                <button type="submit" name="submit">Update</button>
        </form>
        
        <?php 
        unset($_SESSION["error"]); 
        unset($_SESSION['nameErr']);
        
        require_once '../view/footer.php';
        ?>
</body>