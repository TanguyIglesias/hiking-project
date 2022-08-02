<?php
session_start();
require_once '../Model/Tag.php';
$title = 'Edit Tags';
$hike_id = $_GET['hikeID'];
$tag = new Tag();
$getTag = $tag->getTag();
$tagInfo = $tag->linkTag($hike_id);
$tagArr = array();
array_push($tagArr,...$tagInfo);



echo '<pre>';
var_dump(...$tagArr);
echo '</pre>';

require_once '../view/head.php';

?>

<body>
<?php require_once '../view/header.php';?>
    <ol>
        <?php foreach ( $getTag as $key => $value):  ?>
            <li><p><?= $value['tag_name']?> </p></li>
        <?php endforeach ?>
    </ol>
</body>

