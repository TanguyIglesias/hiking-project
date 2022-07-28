<?php 
require '../Model/userInfo.php';
require_once '../Model/hikeInfo.php';
require_once '../view/head.php'; 

$user= new UserInfo;
$userInfo = $user->userInfo();
echo '<pre>';
var_dump($userInfo);
echo '</pre>';

$firstname = $userInfo["firstname"];
$lastname = $userInfo["lastname"];
$nickname = $userInfo["nickname"];
$mail = $userInfo["mail"];
$password = $userInfo["password"];
$city = $userInfo["city"];
$country = $userInfo["country"];

?>

<body>
    <h1></h1>
</body>
<?php require_once '../view/footer.php'; ?>