PLUS BESOIN DE CE FICHIER !!!!

<?php
require_once '../Model/Tag.php';

// echo '<pre>';
// var_dump($_POST['tag_id']);
// echo '</pre>';
// var_dump($hike_id);

$hike_id = $_GET['hikeID'];

$tag_id = $_POST['tag_id'];

$tag = new Tag();

$tag->deleteRelation($hike_id);

foreach($tag_id as $value){
    $tag->addRelation($value, $hike_id);
}

header("Location:/hike?hikeID=$hike_id");
unset($_SESSION["hikeID"]);