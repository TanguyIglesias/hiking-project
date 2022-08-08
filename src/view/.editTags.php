<?php
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

//require_once '../view/head.php';
require_once '../view/header.php';

// echo '<pre>';
// var_dump($tagArr);
// echo '</pre>';

// echo '<pre>';
// var_dump($hike_id);
// echo '</pre>';
    
?>

<body>
    <form action="/editTag?hikeID=<?= $hike_id ?>" method="POST">

            <?php foreach ( $getTag as $key => $value):  ?>
                <input type="checkbox" value="<?= $value['tag_id']?>" name="tag_id[]" 
                
                
                <?php foreach($tagArr as $key => $tag){

                    if($tag["tag_name"] == $value['tag_name'])echo 'checked="checked"';

                    }?>><?= $value['tag_name']?></br> 

                <?php endforeach ?>

        <button type="submit" name="editTag">Modifier</button>
    </form>
</body>

