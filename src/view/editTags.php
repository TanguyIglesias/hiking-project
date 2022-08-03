<?php
session_start();
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



echo '<pre>';
var_dump($tagArr);
echo '</pre>';

echo '<pre>';
var_dump($hike_id);
echo '</pre>';

require_once '../view/head.php';

?>

<body>
<?php require_once '../view/header.php';?>
    <form method="POST" action="/editTag">
            <?php foreach ( $getTag as $key => $value):  ?>
                <input type="checkbox" value="<?= $value['tag_id']?>" name="tag_name[]" 
                
                
                <?php foreach($tagArr as $key => $tag){
                    if($tag["tag_name"] == $value['tag_name'])echo 'checked="checked"';}?>> 
                      
                    <?= $value['tag_name']?></br>    
            <?php endforeach ?>
        <button type="submit" name="editTag">Modifier</button>
    </form>
</body>

