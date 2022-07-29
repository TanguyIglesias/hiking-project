<?php
    session_start();
        //session_destroy();
        unset ($_SESSION['firstname']);
        unset($_SESSION["user_id"]);
        unset($_SESSION["firstname"]);
        unset($_SESSION["lastname"]);
        unset($_SESSION["nickname"]);
        unset($_SESSION["mail"]);
        unset($_SESSION["password"]);
        unset($_SESSION["city"]);
        unset($_SESSION["country"]);
        //$_SESSION = array();
        header("Location:/");



    