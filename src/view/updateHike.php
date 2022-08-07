<?php
if (!isset($_SESSION)) { session_start(); }

///// TAG /////
require_once '../Model/Tag.php';

$title = 'Edit Tags';

$hike_id = $_GET['hikeID'];

$tag = new Tag();
$getTag = $tag->getTag();
$tagInfo = $tag->linkTag($hike_id);
$tagArr = array();

foreach ($tagInfo as $key => $value)
{
array_push($tagArr,$tag->getTagById($value['tag_id']));
}

///// Hike /////
require_once '../Model/hikeInfo.php';

$hike_id = $_GET['hikeID'];
$hike= new HikeInfo;
$hikeInfo = $hike->hikeInfo($hike_id);

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
        <main class="updateHike-main">
                                <form action="/sendUpdateHikes?hikeID=<?=$hike_id?>" method="POST">

                        <input type="text" name="hike_name" placeholder="Nom du hike" value="<?=$hikeName?>">
                        <span style="color:red"><?= (isset($_SESSION['nameErr'])) ? $_SESSION['nameErr'] : "" ?></span>
                        <span style="color:red"><?= (isset($_SESSION['nameDupes'])) ? $_SESSION['nameDupes'] : "" ?></span>
                        <br>
                        <input type="text" name="distance" placeholder="Distance" value="<?=$hikeDistance?>">
                        <span style="color:red"><?= (isset($_SESSION['distanceErr'])) ? $_SESSION['distanceErr'] : "" ?></span>
                        <br>
                        <input type="text" name="elevation_gain" placeholder="Dénivellation" value="<?=$hikeElevation?>">
                        <span style="color:red"><?= (isset($_SESSION['elevationErr'])) ? $_SESSION['elevationErr'] : "" ?></span>
                        <br>
                        <input type="time" name="duration" placeholder="Durée" value="<?=$hikeDuration?>">
                        <span style="color:red"><?= (isset($_SESSION['durationErr'])) ? $_SESSION['durationErr'] : "" ?></span>
                        <br>
                        <input type="text" name="content" placeholder="Description" value="<?=$hikeContent?>">
                        <span style="color:red"><?= (isset($_SESSION['contentErr'])) ? $_SESSION['contentErr'] : "" ?></span>
                        <br>
                        <input type="text" name="image_path" placeholder="url image" value="<?=$hikeImage?>">
                        <span style="color:red"><?= (isset($_SESSION['urlErr'])) ? $_SESSION['urlErr'] : "" ?></span>
                        <br>
                        <p>Date de la dernière modification : <?= $hikeUpdateDate?></p>


                        <button type="button" class="collapsible">Tags</button>
                        <div style="display:none">

                                <?php foreach ( $getTag as $key => $value):  ?>
                                <input type="checkbox" value="<?= $value['tag_id']?>" name="tag_id[]" 
                                
                                <?php foreach($tagArr as $key => $tag){

                                        if($tag["tag_name"] == $value['tag_name'])echo 'checked="checked"';

                                        }?>><?= $value['tag_name']?><br>

                                <?php endforeach ?>
                        </div>




                        <button type="submit" name="update_hike">Update</button>
                        <p class="label is-small has-text-danger" style="color:red"><?= (isset($_SESSION['error'])) ? $_SESSION['error'] : "" ?></p>
                </form>
        
        </main>
        <script>
                var coll = document.getElementsByClassName("collapsible");
                var i;

                for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        var content = this.nextElementSibling;
                        if (content.style.display === "block") {
                        content.style.display = "none";
                        } else {
                        content.style.display = "block";
                        }
                });
                }
        </script>
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
        ?>
        <?php require_once '../view/footer.php'?>
</body>