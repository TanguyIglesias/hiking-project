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
    <a href="/update"><button  name="edit">Modifier</button></a>
    <h1><?= $firstname . " " . $lastname ?></h1>
    <section>
        <div>
            <p>Nickname: <?= $nickname ?></p>
            <p>E-mail: <?= $mail?></p>
            <p>City: <?= $city ?></p>
            <p>Country: <?= $country ?></p>
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
        <a href="/createhike"><button type="button" name="add_hike">ajouter un hike</button></a>
    </section>
    <section>
        <h3>Gestion administration</h3>
        <div>
            <button type="button" name="admin_delete_user">supprimer un utilisateur</button>
            <button type="button" name="admin_delete_hike">supprimer un hike</button>
            <button type="button" name="admin_delete_tag">supprimer un tag</button>
        </div>

    </section>
</body>
<?php require_once '../view/footer.php'; ?>