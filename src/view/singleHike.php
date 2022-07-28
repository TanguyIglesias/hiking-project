<?php 

require_once '../Model/hikeInfo.php';

$hike = new HikeInfo;
$hikeInfo = $hike->hikeInfo();


$hike_name = $hikeInfo["hike_name"];
$distance = $hikeInfo["distance"];
$elevationGain = $hikeInfo["elevation_gain"];
$duration = $hikeInfo["duration"];
$creationDate = $hikeInfo["creation_date"];
$updateDate = $hikeInfo["update_date"];
$image = $hikeInfo ["image_path"];
$content = $hikeInfo ["content"];
$title=$hike_name;
require_once '../view/head.php'; 

?>

<body>
    <?php require_once '../view/header.php'; ?>
    <figure>
        
    </figure>
    <h1><?= $hike_name ?></h1>
    <section>
        <ul>            
            <li><?= $distance ?> km </li>
            <li><?= $elevationGain ?> m</li>
            <li><?= $duration ?></li>
            <li><?= $creationDate ?></li>
            <li><?= $updateDate ?></li>
        </ul>
    </section>
    <section>
        <p><?= $content ?></p>
    </section>
    <section>
        <button type="submit" name="validate_favorite">Mettre dans mes favoris</button>
        <button type="button" name="modifier_hike">Modifier des informations (uniquement créateur ou admin)</button>
        <button type="button" name="supprimer_hike">Supprimer les informations (uniquement créateur ou admin)</button>
    </section>
    <?php require_once '../view/footer.php'; ?>
</body>