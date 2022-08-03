<?php
session_start();
require_once '../Model/Tag.php';
$title = 'Tags';
$tag = new Tag();
$getTag = $tag->getTag();


// echo '<pre>';
// var_dump($getTag);
// echo '</pre>';
require_once '../view/head.php';

?>

<body>
    <?php require_once '../view/header.php';?>
    <ol>
        <?php foreach ( $getTag as $key => $value):  ?>
            <li><p><?= $value['tag_name']?> </p></li>
        <?php endforeach ?>
    </ol>


    <form action="/addTags" method="POST">
        <input type="text" name="tag_name" placeholder="Add Tags">
        <button type="submit" name="AddTag">Add</button>
    </form>
</body>

<?php
require_once '../view/footer.php';
?>
