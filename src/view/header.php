
<?php
require '../Model/register.php';
?>

<header style="text-align: center; background-color: lightgrey; padding-bottom: 20px; width:100%">
    <div>
        <img src="" alt="">
        <a href="/" style="text-decoration: none; color: black"><h1>Hiking Project</h1></a>
    </div>
    <div>
        <input type="text" placeholder="Search Hike">
        <div>
            <button>Log In</button>
            <a href="/registration"><button>Sign In</button></a>
            <form action="/register" method="post">
                <input type="submit" value="Login">
            </form>

            <button>Sign In</button>
        </div>
    </div>
</header>