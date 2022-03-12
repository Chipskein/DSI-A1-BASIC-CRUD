<?php
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION["userid"]))
    {
        header("Location:/assets/view/login.php");
    }
    else
    {
        header("Location:/assets/view/main.php");
    }
?>