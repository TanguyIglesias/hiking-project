<?php

require_once '../Model/hikeInfo.php';
$hike_id = $_GET['hikeID'];
$hike = new HikeInfo;
$hikeInfo = $hike->hikeInfo($hike_id);


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
    <figure>
        <img src="<?= $image?>" alt="Photo du paysage">
    </figure>
    <h1><?= $hike_name ?></h1>
    <section>
        <ul>
            <li><?= $distance ?> km </li>
            <li><?= $elevationGain ?> m</li>
            <li><?= $duration ?></li>
            <li><?= $creationDate ?></li>
            <li><?= $updateDate ?></li>
            <li>Created by:<?= $creatorFirstname ?> <?= $creatorLastname ?></li>
        </ul>
    </section>
    <section>
        <div>
            <p><?= $content ?></p>
        </div>
    </section>
    <section>
        <div>
            <button type="submit" name="validate_favorite">Mettre dans mes favoris</button>
            <button type="button" name="edit_hike">Modifier des informations (uniquement créateur ou admin)</button>
            <button type="button" name="delete_hike">Supprimer les informations (uniquement créateur ou admin)</button>
        </div>
    </section>
    <?php require_once '../view/footer.php'; ?>
</body>