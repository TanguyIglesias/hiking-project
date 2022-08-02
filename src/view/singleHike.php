<?php 
if (!isset($_SESSION)) { session_start(); }

require_once '../Model/hikeInfo.php';
require_once '../Model/Tag.php';
$hike_id = $_GET['hikeID'];
$hike = new HikeInfo;
$hikeInfo = $hike->hikeInfo($hike_id);

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
$creationDate = $hikeInfo["creation_date"];
$updateDate = $hikeInfo["update_date"];
$image = $hikeInfo["image_path"];
$content = $hikeInfo["content"];
$title=$hike_name;

require_once '../Model/userInfo.php';
$user= new UserInfo;
$userInfoByID = $user->userInfoByID($userID);

$creatorFirstname = $userInfoByID['firstname'];
$creatorLastname = $userInfoByID['lastname'];

require_once '../view/head.php'; 

?>

<body>
    <?php require_once '../view/header.php'; ?>
    <figure>
        
    </figure>
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
            <li><p><?= $value['tag_name']?> </p></li>
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
            
            
            <?php if($_SESSION['user_id'] === $userID || $_SESSION['user_admin'] === 1 ): ?>
                <button type="button" name="edit_hike">Modifier des informations (uniquement créateur ou admin)</button>
                <button type="button" name="delete_hike">Supprimer les informations (uniquement créateur ou admin)</button>
                <a href="/editTags?hikeID=<?= $hike_id ?>"><button type="button" name="edit_tags">Modifier les Tags (uniquement créateur ou admin)</button></a>
            <?php endif; ?>   

        </div>
    </section>
    <?php require_once '../view/footer.php'; ?>
</body>