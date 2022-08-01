<?php
if (!isset($_SESSION)) { session_start(); }
require '../Model/test.php';
$hikes = new HikeManager();
$hikesInfo = $hikes->getHikes();
$title = 'Homepage';
require_once '../view/head.php';
?>

<body>
  <?php require_once '../view/header.php' ?>

  <?php foreach ($hikesInfo as $key => $value) : ?>
    <div>
      <h3><?= $value['hike_name'] ?></h3>
      <img src="<?= $value["image_path"]?>" alt="Photo: <?= $value['hike_name'] ?>" style="width:30%";>
      <p>Date mise à jour: <?= $value['update_date'] ?></p>
      <p>Temps: <?= $value['duration'] ?></p>
      <p>Distance: <?= $value['distance'] ?>km</p>
      
      <a href="/hike?hikeID=<?php echo $value['hike_id'] ?>">
        <h3><?= $value['hike_name'] ?></h3>
        <img src="" alt="Photo: <?= $value['hike_name'] ?>">
        <p>Date mise à jour: <?= $value['update_date'] ?></p>
        <p>Temps: <?= $value['duration'] ?></p>
        <p>Distance: <?= $value['distance'] ?>km</p>
      </a>
    
    </div>
  <?php endforeach ?>
  <?php require_once '../view/footer.php'; ?>

</body>

</html>