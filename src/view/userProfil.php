<?php 
require '../Model/userInfo.php';
require '../Model/test.php';
require '../Model/Tag.php';
$hikes = new HikeManager();
$hikesInfo = $hikes->getHikes();
$tags = new Tag();
$tag = $tags->getTag();



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

<body>
    <?php require_once '../view/header.php';?>
    <main class="userProfile-main">
            
        <h1><?= $firstname . " " . $lastname ?></h1>
        <section>
            <div>
                <p>Nickname: <?= $nickname ?></p>
                <p>E-mail: <?= $mail?></p>
                <p>City: <?= $city ?></p>
                <p>Country: <?= $country ?></p>
            </div>
            <a href="/update"><button  name="edit">Edit Profile</button></a>
        </section>

        <button type="button" class="collapsible">Favorite</button>
        <section id="favPanel" style="display:none">
            <h3>Favoris</h3>
            <div>

            </div>
        </section>

        <button type="button" class="collapsible">Hikes Created</button>
        <section id="hikePanel" style="display:none">

            <h3>Mes randonnées crées</h3>
            <div class="allHikes">
                <?php
                    
                    $hikes = new HikeManager();
                    $hikesInfo = $hikes->getHikes();
                    //var_dump($hikesInfo);
                ?>

                <?php foreach ($hikesInfo as $key => $value) : ?>
                    <?php
                        $hike_id = $value['hike_id'];
                        $tag = new Tag();
                        $tagInfo = $tag->linkTag($hike_id);
                    ?>
                    <?php if($value['user_id'] === $_SESSION['user_id']): ?>
                        <div class="createdHike">
                            <a href="/hike?hikeID=<?php echo $value['hike_id'] ?>">
                                <div>
                                    <h3><?= $value['hike_name'] ?></h3>
                                    <img src="<?= $value["image_path"]?>" alt="Photo: <?= $value['hike_name'] ?>";>
                                    <p>Date mise à jour: <?= $value['update_date'] ?></p>
                                    <p>Temps: <?= $value['duration'] ?></p>
                                    <p>Distance: <?= $value['distance'] ?>km</p>
                                    <ol>
                                        <?php foreach ( $tagInfo as $key => $value):  ?>
                                            <?php
                                            $tag = new Tag();
                                            $tagName = $tag->getTagById($value['tag_id'])
                                            ?>
                                            <li><p>#<?= $tagName['tag_name']?> </p></li>
                                        <?php endforeach ?>
                                    </ol>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach ?>
            </div>
            <a href="/createhike"><button type="button" name="add_hike">ajouter un hike</button></a>
        </section>

        <?php if($_SESSION['user_admin'] === 1 ): ?>

            <button type="button" class="collapsible">Admin Panel</button>
            <section id="adminPanel" style="display:none">
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
                        <th style="width:25%;">Nickname</th>
                        <th style="width:25%;">Firstame</th>
                        <th style="width:25%;">Lastname</th>
                        <th style="width:25%;"></th>
                    </th>

                    <?php foreach ( $user as $key => $value):  ?>

                        <tr>
                            <td><?= $value['user_id']?></td>
                            <td><?= $value['nickname']?></td>
                            <td><?= $value['firstname']?></td>
                            <td><?=$value['lastname']?></td>
                            <td>
                                <form action="/deleteUser" method="POST" onsubmit="return confirm('Are you sure you want to delete this user: <?=$value['nickname']?>');">
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
                            <th style="width:50%;">Hike ID</th>
                            <th style="width:50%;">Name</th>
                        </th>

                        <?php foreach ($hike as $key => $value):  ?>

                            <tr>
                                <td><?= $value['hike_id']?></td>
                                <td><?= $value['hike_name']?></td>

                                <td>
                                    <form action="/deleteHike" method="POST" onsubmit="return confirm('Are you sure you want to delete this hike: <?=$value['hike_name']?>');">
                                        <input type="text" name="deleteHikeId" value="<?=$value['hike_id']?>" style="display:none">
                                        <button type="submit" name="submit">Delete</button>
                                    </form>
                                    <a href="/hike?hikeID=<?= $value['hike_id']?>"><button type="button" name="HomePage">Edit</button></a>
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
                            <th style="width:50%;">Tag ID</th>
                            <th style="width:50%;">Name Tag</th>
                        </th>

                        <?php foreach ( $tag as $key => $value):  ?>

                            <tr>
                                <td><?= $value['tag_id']?></td>
                                <td><?= $value['tag_name']?></td>

                                <td>
                                    <form action="/deleteTag" method="POST" onsubmit="return confirm('Are you sure you want to delete this tag: <?=$value['tag_name']?>');">
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
        <a href="/"><button type="button" name="HomePage">Homepage</button></a>

        <script>
            var coll = document.getElementsByClassName("collapsible");
            var i;

            for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                content.style.display = "none";
                } else {
                content.style.display = "block";
                }
            });
            }
        </script>
        
    </main>
    <?php require_once '../view/footer.php'; ?>

</body>
