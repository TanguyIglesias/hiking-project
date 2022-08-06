<?php
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
        <span style="color:red"><?= (isset($_SESSION['error'])) ? $_SESSION['error'] : "" ?></span>
        <span style="color:red"><?= (isset($_SESSION['tagErr'])) ? $_SESSION['tagErr'] : "" ?></span>
        <span style="color:red"><?= (isset($_SESSION['nameErr'])) ? $_SESSION['nameErr'] : "" ?></span>
        <button type="submit" name="AddTag">Add</button>
    </form>
    <a href="/createhike"><button type="button" name="createhike">Back To Create Hike</button></a>
</body>

<?php
unset($_SESSION['error']);
unset($_SESSION['tagErr']);
unset($_SESSION['nameErr']);

require_once '../view/footer.php';
?>
