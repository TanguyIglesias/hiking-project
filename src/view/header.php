<?php
//require '../Model/register.php';
//if (!isset($_SESSION)) { session_start(); } 
?>

<header style="text-align: center; background-color: lightgrey; padding-bottom: 20px; width:100%">
    <div>
        <img src="" alt="">
        <a href="/" style="text-decoration: none; color: black"><h1>Hiking Adventure Time</h1></a>
    </div>
    <div>
        <!-- <input type="text" placeholder="Search Hike"> -->
<!--         <input type="text" id="seachInput" onkeyup="searchFunction()" placeholder="Search...">
        <script>
            function searchFunction() {
                    // Declare variables
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("searchInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("allHikes");
                    tr = table.getElementsByTagName("div"); //tr

                    // Loop through all table rows, and hide those who don't match the search query
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("p")[1]; //td
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
        </script> -->
        <div>
            <?php

                // var_dump($_SESSION);

                if(isset($_SESSION['firstname'])) :?>
                    <p>Connected as <a href="/user"><?=($_SESSION['nickname']);?></a></p> 
                    <form action="/logout" method="post">
                    <input type="submit" value="Logout" name="logout">
                    </form>
                <?php endif; ?>   
                <?php if(!isset($_SESSION['firstname'])) :?>
                    <p>Session not started, please Login</p>
                    <form action="/register" method="post">
                    <input type="text" name="nickname" placeholder="Nickname">
                    <br>
                    <input type="password" name="password" placeholder="Password">
                    <br>
                    <input type="submit" value="Login" name="login">
                    </form>
                    <a href="/registration"><button>Sign In</button></a>
                    <?php endif; ?>   
        <?php       
/* 
                if(isset($_POST['logout']))
                { 
                    //unset ($_SESSION);
                    $_SESSION = array();
                    header("Location:/");
                } */
            ?>
            
        </div>
    </div>
</header>