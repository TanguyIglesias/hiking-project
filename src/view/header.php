<?php
//require '../Model/register.php';
//if (!isset($_SESSION)) { session_start(); } 
// var_dump($_SESSION);
?>

<header>
    <div>
        <img src="" alt="">
        <a href="/" style="text-decoration: none; color: black"><h1>Hiking Adventure Time</h1></a>
    </div>
    <nav>
        <?php
        if($_SERVER['REQUEST_URI'] === "/"){
            echo '<input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search...">';
        }
        else {
            echo "<span></span>";
        }
        
        ?>
        <div>
            <?php
                //var_dump($_SERVER['REQUEST_URI']);

                if(isset($_SESSION['firstname'])) :?>
                    <p>Connected as <a href="/user"><?=($_SESSION['nickname']);?></a></p> 
                    <form action="/logout" method="post">
                        <input class="button" type="submit" value="Logout" name="logout">
                    </form>
                <?php endif; ?>   
                <?php if(!isset($_SESSION['firstname'])) :?>
                    <p>Please login for more option</p>

                    <form action="/register" method="post">
                        <input type="text" name="nickname" placeholder="Nickname">
                        <br>
                        <input type="password" name="password" placeholder="Password">
                        <br>
                        <input class="button" type="submit" value="Login" name="login">
                    </form>
                    <br>
                    <a href="/registration"><button>Sign Up</button></a>
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
    </nav>
</header>