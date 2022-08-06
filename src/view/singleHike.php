<?php

require_once '../Model/hikeInfo.php';
require_once '../Model/Tag.php';
$hike_id = $_GET['hikeID'];
$hike = new HikeInfo;
$hikeInfo = $hike->hikeInfo($hike_id);
//$_SESSION["hikeID"] = $hike_id;

$tag = new Tag();
$tagInfo = $tag->linkTag($hike_id);
$tagArr = array();
foreach ($tagInfo as $key => $value)
{
    array_push($tagArr,$tag->getTagById($value['tag_id']));
}

// echo '<pre>';
// var_dump($tagInfo);
// echo '</pre>';

// echo '<pre>';
// var_dump($tagArr);
// echo '</pre>';

$hike_name = $hikeInfo["hike_name"];
$userID = $hikeInfo["user_id"];
$distance = $hikeInfo["distance"];
$elevationGain = $hikeInfo["elevation_gain"];
$duration = $hikeInfo["duration"];
$creationDate = $hike->orderCreationData($hike_id);
$updateDate = $hike->orderUpdateData($hike_id);
$image = $hikeInfo["image_path"];
$content = $hikeInfo["content"];
$title = $hike_name;

require_once '../Model/userInfo.php';
$user = new UserInfo;
$userInfoByID = $user->userInfoByID($userID);

$creatorFirstname = $userInfoByID['firstname'];
$creatorLastname = $userInfoByID['lastname'];


require_once '../view/head.php';

?>

<body>
    <?php require_once '../view/header.php'; ?>
    <h1><?= $hike_name ?></h1>
    <section>
        <img src="<?=$image?>" alt="<?= $hike_name ?>" style="width:50%;">
        <ul>            
            <li>Distance: <?= $distance ?> km </li>
            <li>Gain d'élévation: <?= $elevationGain ?> m</li>
            <li>Durée: <?= $duration ?></li>
            <li>Date de création: <?= $creationDate ?></li>
            <li>Date de mise à jour: <?= $updateDate ?></li>
            <li>Created by: <?=$creatorFirstname?> <?=$creatorLastname?></li>
        </ul>
        <p>Tags:</p>
        <ol>
        <?php foreach ( $tagArr as $key => $value):  ?>
            <li><?= $value['tag_name']?></li>
        <?php endforeach ?>
    </ol>
    </section>
    <section>
        <div>
            <p><?= $content ?></p>
        </div>
    </section>
    <section>
        <div>
            <button type="submit" name="validate_favorite">Mettre dans mes favoris</button>
            
            <?php if(isset($_SESSION['user_id'])):?>
                <?php if($_SESSION['user_id'] === $userID || $_SESSION['user_admin'] === 1 ): ?>
                    <a href="/updateHike?hikeID=<?= $hike_id ?>"><button type="button" name="edit_hike">EDIT Hike</button></a>
                
                    <form action="/deleteHike" method="POST" onsubmit="return confirm('Are you sure you want to delete this hike: <?=$hike_name?>');">
                        <input type="text" name="deleteHikeId" value="<?=$hike_id?>" style="display:none">
                        <button type="submit" name="submit">Delete</button>
                    </form>
                    
                <?php endif; ?>
            <?php endif; ?> 
            <a href="/"><button type="button" name="HomePage">Homepage</button></a>
        </div>
    </section>
    <?php require_once '../view/footer.php'; ?>
</body>