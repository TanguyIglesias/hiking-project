<?php

require '../Model/test.php';
$hikes= new HikeManager;
$hike = $hikes->getHikes();


?>

<ol>
    <?php foreach ( $hike as $key => $value):  ?>
        <li><p><?= $value['firstname'] . ' ' . $value['lastname']?> </p></li>

        <?php endforeach ?>
</ol>