<?php
//require '../Model/register.php';
if (!isset($_SESSION)) { session_start(); } 
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
                //session_destroy();

                var_dump($_SESSION);

                if(isset($_SESSION['firstname'])) {
                    echo "Your Nickname is" . ($_SESSION['firstname']);
                    echo '<form action="/logout" method="post">
                    <input type="submit" value="LogOut" name="logout">
                    </form>';
                    
                }
                else {
                    echo "Session not started, please Login";
                    echo '<form action="/register" method="post">
                        <input type="text" name="nickname" placeholder="Nickname">
                        <br>
                        <input type="password" name="password" placeholder="Password">
                        <br>
                        <input type="submit" value="Login" name="login">
                    </form>
                    <a href="/registration"><button>Sign In</button></a>';
                }
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