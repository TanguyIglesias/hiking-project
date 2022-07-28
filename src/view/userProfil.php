<?php 
require '../Model/userInfo.php';


$user= new UserInfo;
$userInfo = $user->userInfo();
// echo '<pre>';
// var_dump($userInfo);
// echo '</pre>';

$firstname = $userInfo["firstname"];
$lastname = $userInfo["lastname"];
$nickname = $userInfo["nickname"];
$mail = $userInfo["mail"];
$password = $userInfo["password"];
$city = $userInfo["city"];
$country = $userInfo["country"];
$title="$firstname $lastname";
require_once '../view/head.php'; 
?>
<?php require_once '../view/header.php';?>

<body>
    <h1><?= $firstname . " " . $lastname ?></h1>
    <button type="button" name="edit">Modifier</button>
    <section>
        <div>
            <p><?= $nickname ?></p>
            <button type="button" name="edit">Modifier</button>
            <p><?= $mail?></p>
            <button type="button" name="edit">Modifier</button>
            <p><?= $password  ?></p>
            <button type="button" name="edit">Modifier</button>
            <p><?= $city ?></p>
            <button type="button" name="edit">Modifier</button>
            <p><?= $country ?></p>
            <button type="button" name="edit">Modifier</button>
        </div>
    </section>
    <section>
        <h3>Favoris</h3>
        <div>

        </div>
    </section>
        <h3>Mes randonnées crées</h3>
        <div>

        </div>
    <section>
        <button type="button" name="add_hike">ajouter un hike</button>
    </section>
</body>
<?php require_once '../view/footer.php'; ?>