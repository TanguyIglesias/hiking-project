<?php
//require '../Model/register.php';
//if (!isset($_SESSION)) { session_start(); } 
?>

<header style="text-align: center; background-color: lightgrey; padding-bottom: 20px; width:100%">
    <div>
        <img src="" alt="">
        <a href="/" style="text-decoration: none; color: black"><h1>Hiking Project</h1></a>
    </div>
    <div>
        <input type="text" placeholder="Search Hike">
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