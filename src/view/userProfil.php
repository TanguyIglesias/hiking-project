<?php 
require '../Model/userInfo.php';
require '../Model/test.php';


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
$userID= $userInfo['user_id'];

require_once '../view/head.php'; 
?>
<?php require_once '../view/header.php';?>

<body>
    <main>
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
                <?php
                    
                    $hikes = new HikeManager();
                    $hikesInfo = $hikes->getHikes();
                    //var_dump($hikesInfo);
                ?>

                <?php foreach ($hikesInfo as $key => $value) : ?>
                    <?php if($value['user_id'] === $_SESSION['user_id']): ?>
                        <div>
                            <a href="/hike?hikeID=<?php echo $value['hike_id'] ?>">
                                <div>
                                <h3><?= $value['hike_name'] ?></h3>
                                <img src="<?= $value["image_path"]?>" alt="Photo: <?= $value['hike_name'] ?>" style="width:30%";>
                                <p>Date mise à jour: <?= $value['update_date'] ?></p>
                                <p>Temps: <?= $value['duration'] ?></p>
                                <p>Distance: <?= $value['distance'] ?>km</p>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach ?>

            </div>
        <section>
            <a href="/createhike"><button type="button" name="add_hike">ajouter un hike</button></a>
        </section>

        
        <?php if($_SESSION['user_admin'] === 1 ): ?>
            <section>
                <h3>Gestion administration</h3>

                <div class="tab">
                    <button class="tablinks" onclick="openTab(event, 'users')">USERS</button>
                    <button class="tablinks" onclick="openTab(event, 'hikes')">HIKES</button>
                    <button class="tablinks" onclick="openTab(event, 'tags')">TAGS</button>
                </div>

                <script>
                    function openTab(evt, cityName) {
                        // Declare all variables
                        var i, tabcontent, tablinks;

                        // Get all elements with class="tabcontent" and hide them
                        tabcontent = document.getElementsByClassName("tabcontent");
                        for (i = 0; i < tabcontent.length; i++) {
                            tabcontent[i].style.display = "none";
                        }

                        // Get all elements with class="tablinks" and remove the class "active"
                        tablinks = document.getElementsByClassName("tablinks");
                        for (i = 0; i < tablinks.length; i++) {
                            tablinks[i].className = tablinks[i].className.replace(" active", "");
                        }

                        // Show the current tab, and add an "active" class to the button that opened the tab
                        document.getElementById(cityName).style.display = "block";
                        evt.currentTarget.className += " active";
                    }
                </script>

                <div id="users" class="tabcontent" style="display: block">

                    <?php

                    $users= new UserManager;
                    $user = $users->getUsers();
                    ?>

                    <input type="text" id="userInput" onkeyup="userFunction()" placeholder="Search by user name...">

                    <table id="userTable">
                    <tr class="header">
                        <th style="width:25%;">User ID</th>
                        <th style="width:25%;">Firstame</th>
                        <th style="width:25%;">Lastname</th>
                        <th style="width:25%;"></th>
                    </th>

                    <?php foreach ( $user as $key => $value):  ?>

                        <tr>
                            <td><?= $value['user_id']?></td>
                            <td><?= $value['firstname']?></td>
                            <td><?=$value['lastname']?></td>
                            <td>
                                <form action="/deleteUser" method="POST">
                                    <input type="text" name="deleteUser" value="<?=$value['user_id']?>" style="display:none">
                                    <button type="submit" name="submit">Delete</button>
                                </form>
                            </td>
                        </tr>

                    <?php endforeach ?>
                    </table>

                    <script>
                        function userFunction() {
                            // Declare variables
                            var input, filter, table, tr, td, i, txtValue;
                            input = document.getElementById("userInput");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("userTable");
                            tr = table.getElementsByTagName("tr");

                            // Loop through all table rows, and hide those who don't match the search query
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[1];
                                if (td) {
                                txtValue = td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                                }
                            }
                        }
                    </script>
                
                </div>

                <div id="hikes" class="tabcontent" style="display: none">
                    
                    <?php
                        //require '../Model/test.php';

                        $hikes= new HikeManager;
                        $hike = $hikes->getHikes();
                        ?>

                        <input type="text" id="hikeInput" onkeyup="hikeFunction()" placeholder="Search by hike name...">

                        <table id="hikeTable">
                        <tr class="header">
                            <th style="width:25%;">Hike ID</th>
                            <th style="width:25%;">Name</th>
                        </th>

                        <?php foreach ( $hike as $key => $value):  ?>

                            <tr>
                                <td><?= $value['hike_id']?></td>
                                <td><?= $value['hike_name']?></td>

                                <td>
                                    <form action="/deleteHike" method="POST">
                                        <input type="text" name="deleteHikeId" value="<?=$value['hike_id']?>" style="display:none">
                                        <button type="submit" name="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>

                        <?php endforeach ?>
                        </table>

                        <script>
                            function hikeFunction() {
                                // Declare variables
                                var input, filter, table, tr, td, i, txtValue;
                                input = document.getElementById("hikeInput");
                                filter = input.value.toUpperCase();
                                table = document.getElementById("hikeTable");
                                tr = table.getElementsByTagName("tr");

                                // Loop through all table rows, and hide those who don't match the search query
                                for (i = 0; i < tr.length; i++) {
                                    td = tr[i].getElementsByTagName("td")[1];
                                    if (td) {
                                    txtValue = td.textContent || td.innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        tr[i].style.display = "";
                                    } else {
                                        tr[i].style.display = "none";
                                    }
                                    }
                                }
                            }
                        </script>
                </div>

                <div id="tags" class="tabcontent" style="display: none">
                    <?php
                        //require '../Model/test.php';

                        $tags= new TagManager;
                        $tag = $tags->getTags();
                        ?>

                        <input type="text" id="tagInput" onkeyup="tagFunction()" placeholder="Search by tag name...">

                        <table id="tagTable">
                        <tr class="header">
                            <th style="width:25%;">Tag ID</th>
                            <th style="width:25%;">Name Tag</th>
                        </th>

                        <?php foreach ( $tag as $key => $value):  ?>

                            <tr>
                                <td><?= $value['tag_id']?></td>
                                <td><?= $value['tag_name']?></td>

                                <td>
                                    <form action="/deleteTag" method="POST">
                                        <input type="text" name="deleteTag" value="<?=$value['tag_id']?>" style="display:none">
                                        <button type="submit" name="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>

                        <?php endforeach ?>
                        </table>

                        <script>
                            function tagFunction() {
                                // Declare variables
                                var input, filter, table, tr, td, i, txtValue;
                                input = document.getElementById("tagInput");
                                filter = input.value.toUpperCase();
                                table = document.getElementById("tagTable");
                                tr = table.getElementsByTagName("tr");

                                // Loop through all table rows, and hide those who don't match the search query
                                for (i = 0; i < tr.length; i++) {
                                    td = tr[i].getElementsByTagName("td")[1];
                                    if (td) {
                                    txtValue = td.textContent || td.innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        tr[i].style.display = "";
                                    } else {
                                        tr[i].style.display = "none";
                                    }
                                    }
                                }
                            }
                        </script>
                </div >
                    
                    

            </section>
        <?php endif; ?>
    </main>
    <?php require_once '../view/footer.php'; ?>

</body>
